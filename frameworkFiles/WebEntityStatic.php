<?php

class WebEntityStatic
{
    /**
     * WebEntityStatic is a class for static directory web entities
     * @var $directory: the directory
     */
    private $directory;
    function __construct($directory) {
        /**
         * Constructor
         * @param $directory: the directory
         */
        $this->directory = $directory;
    }
    function get($fileName)
    {
        /**
         * Returns the web entity as a string
         */
        return file_get_contents($this->directory+ urldecode($fileName));
    }

    function execute($data)
    {
        /**
         * Executes the web entity
         * @param $data: the data
         */
//        echo json_encode($data->matches);
//        echo getcwd().urldecode($this->directory . $data->matches[1]);
        $response = new HTTPResponse();
        $response->body = file_get_contents(getcwd().urldecode($this->directory . $data->matches[1]));
        return $response;
    }

}