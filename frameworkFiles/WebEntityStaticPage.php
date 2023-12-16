<?php

class WebEntityStaticPage
{
    /**
     * WebEntityStaticPage is a class for static web entity page
     * @var $directory: the file directory
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

//        return file_get_contents($this->directory+ urldecode($fileName));
    }

    function execute($data)
    {
        /**
         * Executes the web entity
         * @param $data: the data
         */
        $templater = new Templater(getcwd().urldecode($this->directory . $data->matches[1]));
        $response = new HTTPResponse();
        $response->body = $templater->render();
        return $response;
    }

}