<?php


class Path
{
    /**
     * Path is a class that defines a route path
     * @var $path: the path
     * @var $executable: the executable
     * @var $matches: the matches
     */
    public $path;
    public $executable;
    public $matches = [];

    function __construct($path, $executable) {
        $this->path = $path;
        $this->executable = $executable;
    }

}