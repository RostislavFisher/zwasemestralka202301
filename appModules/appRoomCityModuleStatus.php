<?php

namespace appModules;

use HTTPResponse;

/**
 * appRoomCityModuleStatus is a class that extends TemperatureModule.
 * It is a custom class that is used to display the status of the city.
 *
 */
class appRoomCityModuleStatus extends TemperatureModule
{
    /**
     * This function returns the name of the class.
     */
    public function __toString(){
        return "appRoomCityModuleStatus";
    }

    /**
     * This function returns the status of the city.
     */
    public function execute($listOfAllObjects){

        global $PrahaCity;
        $response = new HTTPResponse();
        $response->body = json_encode(get_object_vars($PrahaCity));
        return $response;
    }
}