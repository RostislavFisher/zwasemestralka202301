<?php

class TemplaterVariable
{
    /**
     * TemplaterVariable is a class that defines a template variable
     * @var $key: the key of the variable
     * @var $value: the value of the variable
     */
    public $key;
    public $value;

    public function __construct($key, $value){
        /**
         * Constructor
         * @param $key: the key of the variable
         * @param $value: the value of the variable
         */
        $this->key = $key;
        $this->value = $value;
    }

}