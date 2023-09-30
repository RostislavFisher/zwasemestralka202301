<?php

class WebEntityStatic
{

    function __construct() {
    }
    function get($fileName)
    {
        return file_get_contents(urldecode($fileName));
    }

    function execute($data)
    {
        return file_get_contents(getcwd().urldecode($data->matches[0]));
    }

}