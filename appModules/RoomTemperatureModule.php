<?php

namespace appModules;

class RoomTemperatureModule extends TemperatureModule
{
    public $name;
    public $description;
    public $icon;
    public $value;
    public function __toString(){

        return json_encode(get_object_vars($this));
    }
    public function execute($listOfAllObjects){

    }
}