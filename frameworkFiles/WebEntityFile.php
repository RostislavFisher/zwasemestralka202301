<?php

class WebEntityFile
{
    /**
     * WebEntityFile is a class for web entities that are files
     * @var $fileName: the name of the file
     */
    public $fileName;

    function __construct($fileName) {
        /**
         * Constructor
         * @param $fileName: the name of the file
         */
        $this->fileName = $fileName;
    }
    function __toString()
    {
        /**
         * Returns the web entity as a string
         */
        return file_get_contents($this->fileName);
    }


    function execute($data)
    {
        /**
         * Executes the web entity
         * @param $data: the data
         */
        $response = new HTTPResponse();
        $response->body = file_get_contents($this->fileName);
        return $response;
    }

}