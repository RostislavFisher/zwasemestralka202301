<?php

namespace appModules;

abstract class TemperatureModule extends Module
{
    public $name;
    public $description;
    public $icon;
    public $value;
    public abstract function __toString();
    public abstract function execute($listOfAllObjects);

}