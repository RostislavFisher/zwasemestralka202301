<?php

class WebEntityStatic
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
//        echo json_encode($data->matches);
//        echo getcwd().urldecode($this->directory . $data->matches[1]);
        $templater = new Templater(getcwd().urldecode($this->directory . $data->matches[1]));
        return $templater->render();
    }

}