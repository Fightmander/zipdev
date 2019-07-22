<?php

namespace Database;

class Connection
{

    const DB_HOST = 'localhost';
    const DB_NAME = 'zipdev';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    private static $connection;

    public static function getInstance()
    {
        if(self::$connection == null){
            self::$connection = Connection::connect();
        }

        return self::$connection;
    }

    private static function connect()
    {
        try{
            return self::$connection = new \PDO(
                "mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME,
                self::DB_USER,
                self::DB_PASSWORD, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES => false
            ));
        }catch (\PDOException $exception){
            die($exception->getMessage());
        }
    }
}