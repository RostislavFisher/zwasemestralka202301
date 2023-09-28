<?php


class Path
{
    public $path;
    public $executable;

    function __construct($path, $executable) {
        $this->path = $path;
        $this->executable = $executable;
    }

}