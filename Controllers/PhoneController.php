<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/17/2019
 * Time: 3:54 PM
 */

namespace Controllers;

include_once $_SERVER['DOCUMENT_ROOT'] . 'Interface/CrudInterface.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'Models/Phone.php';

use Models\Phone;

class PhoneController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    public function create($phone, $phoneBookId)
    {
        $phoneModel = new Phone();
        $phoneModel->phone = $phone;
        $phoneModel->phone_books_id = $phoneBookId;
        $phoneModel->save();
        $phoneModel->id = $this->connection->lastInsertId();

        return $phoneModel;
    }

    public function read($id)
    {
        $query = "select * from phones where id = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$id]);

        return $statement;
    }

    public function update($id, $phone)
    {

    }

    public function delete($id)
    {

    }

}