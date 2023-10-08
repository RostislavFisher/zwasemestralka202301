<?php

class WebEntityStatic
{
    private $directory;
    function __construct($directory) {
        $this->directory = $directory;
    }
    function get($fileName)
    {
        return file_get_contents($this->directory+ urldecode($fileName));
    }

    function execute($data)
    {
//        echo json_encode($data->matches);
//        echo getcwd().urldecode($this->directory . $data->matches[1]);
        $response = new HTTPResponse();
        $response->body = file_get_contents(getcwd().urldecode($this->directory . $data->matches[1]));
        return $response;
    }

}