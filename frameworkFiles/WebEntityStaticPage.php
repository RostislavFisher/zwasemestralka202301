<?php

class WebEntityStaticPage
{
    private $directory;
    function __construct($directory) {
        $this->directory = $directory;
    }
    function get($fileName)
    {
//        return file_get_contents($this->directory+ urldecode($fileName));
    }

    function execute($data)
    {
        $templater = new Templater(getcwd().urldecode($this->directory . $data->matches[1]));
        $response = new HTTPResponse();
        $response->body = $templater->render();
        return $response;
    }

}