<?php
header("Content-Type: application/json; charset=UTF-8");

include_once $_SERVER["DOCUMENT_ROOT"] . '/Database/Connection.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Controllers/EmailController.php';

$connection = \Database\Connection::getInstance();

if(isset($_GET["id"]) && $_GET["id"]){

    $emailController = new \Controllers\EmailController($connection);
    $statement = $emailController->read($_GET["id"]);
    $response = $statement->fetch(PDO::FETCH_ASSOC);

    if($response){

        echo json_encode($response);

    }else{

        echo json_encode(["code" => 404, "message" => "id not found"]);

    }

}else{

    echo json_encode(["code" => 500, "message" => "id value required"]);

}