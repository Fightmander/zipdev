<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/17/2019
 * Time: 3:54 PM
 */

namespace Controllers;

include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Phone.php';

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

    public function update($id, $phoneNumber)
    {
        try{
            $query = "update phones set phone = ? where id = ?";
            $statement = $this->connection->prepare($query);
            $statement->execute([$phoneNumber, $id]);
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
            $query = "delete from phones where id = ?";
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