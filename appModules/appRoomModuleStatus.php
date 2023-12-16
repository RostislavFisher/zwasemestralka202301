<?php

namespace appModules;
use HTTPResponse;

/**
appRoomModuleStatus is a class that extends TemperatureModule.
It is a custom class that is used to display the status of the room.
 */
class appRoomModuleStatus extends TemperatureModule
{

    /**
     * This function returns the object of the class as a string.
     */
    public function __toString(){
    return "appRoomModuleStatus";
    }

    /**
     * This function returns the status of the module.
     */
    public function execute($listOfAllObjects){
        global $AllModules;
        $response = new HTTPResponse();
        $listOfModules = [];

        foreach ($AllModules->modules as $module){
            $jsonModule = get_object_vars($module);
            $jsonModule["type"] = get_class($module);
            $listOfModules[] = $jsonModule;
        }
        $response->body = json_encode($listOfModules);

        return $response;

    }
}