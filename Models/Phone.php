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

class Phone
{
    public $id, $phone, $phone_books_id;
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function save()
    {
        try{
            $sql = "INSERT INTO phones (phone, phone_books_id) values (?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$this->phone, $this->phone_books_id]);

            return (int)$this->connection->lastInsertId();

        }catch (\PDOException $exception){
            //TODO log query
            return $exception->getMessage();
        }
    }
}