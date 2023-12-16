<?php

namespace appModules;

/**
 * RoomTemperatureModule is a class that extends TemperatureModule.
 * It is a custom class that is used to display the status of the room.
 *
 */
class RoomTemperatureModule extends TemperatureModule
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
     * This function returns the name of the class.
     */

    public function __toString(){
        return json_encode(get_object_vars($this));
    }
    /**
     * This function returns the status of the module.
     */
    public function execute($listOfAllObjects){

    }
}