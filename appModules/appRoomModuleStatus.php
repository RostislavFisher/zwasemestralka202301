<?php

namespace appModules;
use HTTPResponse;

class appRoomModuleStatus extends TemperatureModule
{    public function __toString(){
    return "appRoomModuleStatus";
    }
    public function execute($listOfAllObjects){
        global $AllModules;
        $response = new HTTPResponse();
        $response->body = json_encode(get_object_vars($AllModules));

        return $response;

    }
}