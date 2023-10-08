<?php

namespace appModules;

use HTTPResponse;

class appRoomCityModuleStatus extends TemperatureModule
{
    public function __toString(){
        return "appRoomCityModuleStatus";
    }

    public function execute($listOfAllObjects){
        global $PrahaCity;
        $response = new HTTPResponse();
        $response->body = json_encode(get_object_vars($PrahaCity));
        return $response;
    }
}