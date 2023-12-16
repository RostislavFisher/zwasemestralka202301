<?php

/**
 * WebEntityStatic is a class for static directory web entities
 */
class WebEntityStatic
{
    /**
     * @var $directory: the directory
     */
    private $directory;

    /**
     * Constructor
     * @param $directory: the directory
     */
    function __construct($directory) {
        $this->directory = $directory;
    }

    /**
     * Returns the web entity as a string
     */
    function get($fileName)
    {
        return file_get_contents($this->directory+ urldecode($fileName));
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data)
    {
//        echo json_encode($data->matches);
//        echo getcwd().urldecode($this->directory . $data->matches[1]);
        $response = new HTTPResponse();
        $response->body = file_get_contents(getcwd().urldecode($this->directory . $data->matches[1]));
        return $response;
    }

}