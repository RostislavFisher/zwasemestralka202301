<?php

/**
 * Database is an abstract class that defines the methods that a database class should have
 */
abstract class Database
{
    /**
     * @var string $file The file where the database is stored
     */
    public $file = "";
    public $data = [];

    /**
     * opens connection to database
     */
    abstract function open();
    /**
     * saves changes to database
     */
    abstract function save();
    /**
     * adds an object to the database
     * @param $object: the object to add
     */
    abstract function add($object);

    /**
     * returns an object in the database based on the where clause
     * @param $objectClass
     * @param $where : the where clause
     */
    abstract function get($objectClass, $where);

    /**
     * deletes an object from the database based on the where clause
     * @param $objectClass
     * @param $where : the where clause
     */
    abstract function deleteWhere($objectClass, $where);
    /**
     * deletes an object from the database
     * @param $object: the object to delete
     */
    abstract function delete($object);
}