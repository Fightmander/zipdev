<?php
namespace Controllers;

use Models\PhoneBook;

include_once $_SERVER['DOCUMENT_ROOT'] . 'Interface/CrudInterface.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'Models/PhoneBook.php';


class PhoneBookController
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create($firstName, $surName, $image = null)
    {
        $phoneBook = new PhoneBook();
        $phoneBook->firstName = $firstName;
        $phoneBook->surName = $surName;
        $phoneBook->image = $image;
        $phoneBook->save();
        $phoneBook->id = $this->connection->lastInsertId();

        return $phoneBook;
    }

    public function read()
    {
        $query = "select * from phone_books";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;

    }

    public function update($id, $firstName, $surName)
    {
        $phoneBook = new PhoneBook();
        $phoneBook = $phoneBook->find($id);

        $firstName = $firstName ?? $phoneBook["first_name"];
        $surName = $surName ?? $phoneBook["sur_name"];

        try{
            $query = "update phone_books set first_name = ?, sur_name = ? where id = ? ";
            $statement = $this->connection->prepare($query);
            $statement->execute([$firstName, $surName, $id]);
            $affected = $statement->rowCount();

            if($affected > 0) {
                return ["code" => 200, "message" => "updated successfully"];
            }else{
                return ["code" => 200, "message" => "nothing to update"];
            }

        }catch (\PDOException $error){

            return ["code" => 500, "message" => $error->getMessage()];

        }

    }

    public function delete($id)
    {
        try{
            $query = "delete from phone_books where id = ?";
            $statement = $this->connection->prepare($query);
            $statement->execute([$id]);
            $affected = $statement->rowCount();

            if($affected > 0) {
                return ["code" => 200, "message" => "deleted successfully"];
            }else{
                return ["code" => 404, "message" => "id not found"];
            }

        }catch (\PDOException $error){

            return ["code" => 500, "message" => $error->getMessage()];

        }

    }
}