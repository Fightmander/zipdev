<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/14/2019
 * Time: 3:58 PM
 */

namespace Controllers;

class Logger
{
    public static function log($log)
    {
        $log_filename = "../logs/database.log";
        if (!file_exists($log_filename))
        {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }

        file_put_contents($log_filename, $log, FILE_APPEND);
    }
}