<?php

class WebEntityStatic
{

    function __construct() {
    }
    function get($fileName)
    {
        return file_get_contents(urldecode($fileName));
    }

    function execute($listOfAllObjects)
    {
        return file_get_contents(getcwd().urldecode($listOfAllObjects[0]));
    }

}