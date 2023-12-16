<?php

namespace appModules;

class RoomTemperatureModule extends TemperatureModule
{
    /**
     * RoomTemperatureModule is a class that extends TemperatureModule.
     * It is a custom class that is used to display the status of the room.
     *
     */
    public $name;
    public $description;
    public $icon;
    public $value;
    public function __toString(){
        /**
         * This function returns the name of the class.
         */

        return json_encode(get_object_vars($this));
    }
    public function execute($listOfAllObjects){

    }
}