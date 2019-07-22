<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/Logger.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Models/PhoneBook.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Models/Phone.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Models/Email.php';

$result = [];
$telephones = ["2000000", "29012901902", "1029321903"];
$emails = ["welkfwe@weldmpsf.com", "lksmd@qwdsqa.net"];

$phoneBook = new \Models\PhoneBook();
$phoneBook->firstName = "fernando";
$phoneBook->surName = "leon";
$phoneBook->id = $phoneBook->save();

$result["phone_book"] = get_object_vars($phoneBook);

$count = 0 ;
foreach ($telephones  as $tel){
    $phone = new \Models\Phone();
    $phone->phone = $tel;
    $phone->phone_books_id = $phoneBook->id;
    $phone->id = $phone->save();

    $result["phone_book"]["phone"][++$count] = get_object_vars($phone);
}

$count = 0 ;
foreach ($emails as $row){
    $email = new \Models\Email();
    $email->email = $row;
    $email->phone_books_id = $phoneBook->id;
    $email->id = $email->save();

    $result["phone_book"]["email"][++$count] = get_object_vars($email);
}

var_dump($result);

//\Controllers\Logger::log("tas bien pendejo");

