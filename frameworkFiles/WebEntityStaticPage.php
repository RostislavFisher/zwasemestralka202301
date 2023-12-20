<?php

/**
 * WebEntityStaticPage is a class for static web entity page
 */
class WebEntityStaticPage
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
     * Deprecated
     */
    function get($fileName)
    {

//        return file_get_contents($this->directory+ urldecode($fileName));
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data)
    {
        $templater = new Templater(getcwd().urldecode($this->directory . $data->matches[1]));
        $response = new HTTPResponse();
        $response->header->header["Content-Type"] = "text/html";
        $response->body = $templater->render();
        return $response;
    }

}