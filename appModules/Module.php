<?php

namespace appModules;

/**
 * Module is an abstract class that is used to display the status of the modules.
 *
 */
abstract class Module
{
    /**
     * @var string $name is the name of the module.
     */
    public $name;
    /**
     * @var string $description is the description of the module.
     */
    public $description;
    /**
     * @var string $icon is the icon of the module.
     */
    public $icon;
    /**
     * @var string $value is the value of the module.
     */
    public $value;
    /**
     *  string representation of the object.
     */
    public abstract function __toString();
    /**
     *  This function returns the status of the module.
     */
    public abstract function execute($listOfAllObjects);
}