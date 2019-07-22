<?php
/**
 * Created by PhpStorm.
 * User: fadol
 * Date: 7/17/2019
 * Time: 3:56 PM
 */

interface CrudInterface
{
    public function create($firstName, $surName);

    public function read();

    public function update($id, $values = []);

    public function delete($id, $values = []);
}