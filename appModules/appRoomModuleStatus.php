<?php

namespace appModules;
use HTTPResponse;

class appRoomModuleStatus extends TemperatureModule
{
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