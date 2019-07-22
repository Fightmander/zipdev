<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once $_SERVER["DOCUMENT_ROOT"] . 'Database/Connection.php';
include_once $_SERVER["DOCUMENT_ROOT"] . 'Controllers/EmailController.php';

$connection = \Database\Connection::getInstance();

if( (isset($_POST["id"]) && $_POST["id"] != "") && ( isset($_POST["email"]) && $_POST["email"] != "" )){

    $emailController = new \Controllers\EmailController($connection);
    $response = $emailController->update($_POST["id"], $_POST["email"]);

    echo json_encode($response);

}else{

    echo json_encode(["code" => 500, "message" => "id and email values are required"]);

}