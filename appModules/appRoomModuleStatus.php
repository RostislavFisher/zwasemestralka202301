<?php

namespace appModules;
use HTTPResponse;

class appRoomModuleStatus extends TemperatureModule
{
    /**
     appRoomModuleStatus is a class that extends TemperatureModule.
     It is a custom class that is used to display the status of the room.
     *
     */
    public function __toString(){
    return "appRoomModuleStatus";
    }
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