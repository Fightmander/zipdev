<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/14/2019
 * Time: 4:13 PM
 */

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/Database/Connection.php';

use Database\Connection;

class Email
{
    public $id, $email, $phone_books_id;
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function save()
    {
        try{
            $sql = "INSERT INTO emails (email, phone_books_id) values (?, ?)";
            $query = $this->conn->prepare($sql);
            $query->execute([$this->email, $this->phone_books_id]);

            return (int)$this->conn->lastInsertId();

        }catch (\PDOException $exception){
            //TODO log query
            return $exception->getMessage();
        }
    }

}