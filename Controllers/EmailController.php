<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/17/2019
 * Time: 3:54 PM
 */

namespace Controllers;

include_once $_SERVER["DOCUMENT_ROOT"] . "/Models/Email.php";

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

    public function read($id)
    {
        $query = "select * from emails where id = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$id]);

        return $statement;
    }

    public function update($id, $email)
    {
        try{
            $query = "update emails set email = ? where id = ?";
            $statement = $this->connection->prepare($query);
            $statement->execute([$email, $id]);
            $affected = $statement->rowCount();

            if($affected > 0) {
                return ["code" => 200, "message" => "updated successfully"];
            }else{
                return ["code" => 204, "message" => "nothing to update"];
            }

        }catch (\PDOException $error){

            return ["code" => 500, "message" => $error->getMessage()];

        }

    }

    public function delete($id)
    {
        try{
            $query = "delete from emails where id = ?";
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