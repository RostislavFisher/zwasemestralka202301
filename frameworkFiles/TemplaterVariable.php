<?php

/**
 * TemplaterVariable is a class that defines a template variable
 */
class TemplaterVariable
{
    /**
     * @var $key : the key of the variable
     */
    public $key;
    /**
     * @var $value : the value of the variable
     */
    public $value;

    /**
     * Constructor
     * @param $key: the key of the variable
     * @param $value: the value of the variable
     */
    public function __construct($key, $value){
        $this->key = $key;
        $this->value = $value;
    }

}