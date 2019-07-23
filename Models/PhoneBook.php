<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/14/2019
 * Time: 4:12 PM
 */

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/Database/Connection.php';

use Database\Connection;

class PhoneBook
{
    public $id, $firstName, $surName, $image;
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function find($id)
    {
        $query = "select * from phone_books where id = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$id]);

        $phoneBook = $statement->fetch(\PDO::FETCH_ASSOC);

        return $phoneBook;
    }

    public function phones($phoneBookId)
    {
        $query = "select * from phones where phone_books_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$phoneBookId]);

        return $statement;
    }

    public function emails($phoneBookId)
    {
        $query = "select * from emails where phone_books_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$phoneBookId]);

        return $statement;
    }

    public function save()
    {
        try{
            $sql = "INSERT INTO phone_books (first_name, sur_name, image) values (?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $this->firstName);
            $statement->bindParam(2, $this->surName);
            $statement->bindParam(3, $this->image, \PDO::PARAM_LOB);
            $statement->execute();

            return (int)$this->connection->lastInsertId();

        }catch (\PDOException $exception){
            //TODO log query
            return $exception->getMessage();
        }
    }
}