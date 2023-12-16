<?php

/**
 * Path is a class that defines a route path
 * @var $path: the path
 * @var $executable: the executable
 * @var $matches: the matches
 */
class Path
{
    /**
     * @var $path : the path
     */
    public $path;
    /**
     * @var $executable : the executable object
     */
    public $executable;
    /**
     * @var $matches : the matches of the path slugs
     */
    public $matches = [];

    /**
     * Path constructor.
     * @param $path : the path
     * @param $executable : the executable object
     */
    function __construct($path, $executable) {
        $this->path = $path;
        $this->executable = $executable;
    }

}