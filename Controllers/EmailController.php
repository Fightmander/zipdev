<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/17/2019
 * Time: 3:54 PM
 */

namespace Controllers;

include_once $_SERVER["DOCUMENT_ROOT"] . "Database/Connection.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "Models/Email.php";

use Models\Email;

class EmailController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create($email, $phoneBookId)
    {
        $emailModel = new Email();
        $emailModel->email = $email;
        $emailModel->phone_books_id = $phoneBookId;
        $emailModel->save();
        $emailModel->id = $this->connection->lastInsertId();

        return $emailModel;
    }

    public function read()
    {

    }

    public function update($id, $phone)
    {

    }

    public function delete($id)
    {

    }

}