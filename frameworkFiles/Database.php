<?php

abstract class Database
{
    /**
     * Database is an abstract class that defines the methods that a database class should have
     */
    public $file = "";
    public $data = [];

    abstract function open();
    abstract function save();
    abstract function add($object);
    abstract function get($objectClass, $where);
    abstract function deleteWhere($objectClass, $where);
    abstract function delete($object);
}