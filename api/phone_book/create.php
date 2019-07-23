<?php

header("Content-Type: multipart/form-data; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once $_SERVER["DOCUMENT_ROOT"] . 'Database/Connection.php';
include_once $_SERVER["DOCUMENT_ROOT"] . 'Controllers/PhoneBookController.php';
include_once $_SERVER["DOCUMENT_ROOT"] . 'Controllers/PhoneController.php';
include_once $_SERVER["DOCUMENT_ROOT"] . 'Controllers/EmailController.php';

$connection = \Database\Connection::getInstance();
$data = ["phoneBook" => [], "phones" => [], "emails" => []];

if( (isset($_POST["firstName"]) && $_POST["firstName"] != "") && (isset($_POST["surName"]) && $_POST["surName"] != "" )){
    try{
        $connection->beginTransaction();

        if(isset($_FILES["image"]) && $_FILES['image']['size'] > 0){
            $image = file_get_contents($_FILES['image']['tmp_name']);
        }

        $phoneBookController = new \Controllers\PhoneBookController($connection);
        $phoneBook = $phoneBookController->create($_POST["firstName"], $_POST["surName"], $image ?? null);

        if($phoneBook->image != null){
            $phoneBook->image = $_FILES['image']["name"];
        }

        $data["phoneBook"] = $phoneBook;

        $phone = new \Controllers\PhoneController($connection);

        if(isset($_POST["phones"]) && count($_POST["phones"]) > 0 ){

            foreach ($_POST["phones"] as $row){

                $response = $phone->create($row, $phoneBook->id);
                array_push($data["phones"], $response);

            }

        }

        $email = new \Controllers\EmailController($connection);

        if(isset($_POST["emails"]) && count($_POST["emails"]) > 0 ){

            foreach ($_POST["emails"] as $row){

                $response = $email->create($row, $phoneBook->id);
                array_push($data["emails"], $response);

            }

        }


        $connection->commit();

        echo json_encode($data);
    }catch (Exception $exception){
        echo $exception->getMessage();
        $connection->rollBack();
    }

}else{
    echo "firstName and surName values are required";
}

