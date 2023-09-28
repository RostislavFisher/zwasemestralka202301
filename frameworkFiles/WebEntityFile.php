<?php

class WebEntityFile
{
    public $fileName;

    function __construct($fileName) {
        $this->fileName = $fileName;
    }
    function __toString()
    {
        return file_get_contents($this->fileName);
    }


    function execute($listOfAllObjects)
    {
        return file_get_contents($this->fileName);
    }

}