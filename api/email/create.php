<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once $_SERVER["DOCUMENT_ROOT"] . '/Database/Connection.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Controllers/EmailController.php';

$connection = \Database\Connection::getInstance();

if( (isset($_POST["phoneBookId"]) && $_POST["phoneBookId"] != "") && (isset($_POST["email"]) && $_POST["email"] != "" )){

    $email = new \Controllers\EmailController($connection);
    $response = $email->create($_POST["email"], $_POST["phoneBookId"]);

    if($response->id == 0){

        echo json_encode(["code" => 500, "error" => "phoneBookId not found"]);

    }else{

        echo json_encode( $response);

    }

}else{

    echo "phoneBookId and email values are required";

}

