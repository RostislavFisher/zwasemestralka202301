<?php

/**
 * WebEntityFile is a class for web entities that are files
 */
class WebEntityFile
{
    /**
     * @var $fileName: the name of the file
     */
    public $fileName;

    /**
     * Constructor
     * @param $fileName: the name of the file
     */
    function __construct($fileName) {
        $this->fileName = $fileName;
    }

    /**
     * Returns the web entity as a string
     */
    function __toString()
    {
        return file_get_contents($this->fileName);
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data)
    {
        $response = new HTTPResponse();
        $response->body = file_get_contents($this->fileName);
        return $response;
    }

}