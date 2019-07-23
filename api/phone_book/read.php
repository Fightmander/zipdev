<?php
header("Content-Type: application/json; charset=UTF-8");

include_once $_SERVER["DOCUMENT_ROOT"] . '/Database/Connection.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Controllers/PhoneBookController.php';

$connection = \Database\Connection::getInstance();

$phoneBookController = new \Controllers\PhoneBookController($connection);
$phoneBook = new \Models\PhoneBook();

$statement = $phoneBookController->read();

$data = [];
$data["data"] = [];

while($row = $statement->fetch(PDO::FETCH_ASSOC)){

    $phoneBookArray = [
        "id" => $row["id"],
        "firstName" => $row["first_name"],
        'surName' => $row['sur_name'],
        'image' => $row['image'],
        'phones' => [],
        'emails' => []
    ];

    $phones = $phoneBook->phones($row['id']);

    while($phone = $phones->fetch(PDO::FETCH_ASSOC)){
        array_push($phoneBookArray["phones"], $phone["phone"]);
    }

    $emails = $phoneBook->emails($row["id"]);

    while($email = $emails->fetch(PDO::FETCH_ASSOC)){
        array_push($phoneBookArray["emails"], $email["email"]);
    }

    array_push($data["data"], $phoneBookArray);

}

echo json_encode($data);



