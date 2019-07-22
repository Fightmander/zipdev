<?php
header("Content-Type: application/json; charset=UTF-8");

include_once $_SERVER["DOCUMENT_ROOT"] . 'Database/Connection.php';
include_once $_SERVER["DOCUMENT_ROOT"] . 'Controllers/PhoneController.php';

$connection = \Database\Connection::getInstance();

if(isset($_GET["id"]) && $_GET["id"]){

    $phoneController = new \Controllers\PhoneController($connection);
    $statement = $phoneController->read($_GET["id"]);
    $response = $statement->fetch(PDO::FETCH_ASSOC);

    if($response){

        echo json_encode($response);

    }else{

        echo json_encode(["code" => 500, "message" => "id not found"]);

    }

}else{

    echo json_encode(["code" => 500, "message" => "id value required"]);

}