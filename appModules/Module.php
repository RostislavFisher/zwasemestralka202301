<?php

namespace appModules;

abstract class Module
{
    /**
     * Module is an abstract class that is used to display the status of the modules.
     *
     */
    public $name;
    public $description;
    public $icon;
    public $value;
    public abstract function __toString();
    public abstract function execute($listOfAllObjects);
}