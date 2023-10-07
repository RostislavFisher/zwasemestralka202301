<?php

abstract class Database
{
    public $file = "";
    public $data = [];

    abstract function open();
    abstract function save();
    abstract function add($object);
    abstract function get($objectClass, $where);
}