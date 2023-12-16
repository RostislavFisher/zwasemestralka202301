<?php

namespace appModules;

abstract class TemperatureModule extends Module
{
    /**
     * TemperatureModule is an abstract class that is used to display the status of the temperature.
     *
     */
    public $name;
    public $description;
    public $icon;
    public $value;
    public abstract function __toString();
    public abstract function execute($listOfAllObjects);

}