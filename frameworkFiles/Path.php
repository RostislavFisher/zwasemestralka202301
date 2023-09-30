<?php


class Path
{
    public $path;
    public $executable;
    public $matches = [];

    function __construct($path, $executable) {
        $this->path = $path;
        $this->executable = $executable;
    }

}