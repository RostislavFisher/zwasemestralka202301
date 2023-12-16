<?php

namespace appModules;

use HTTPResponse;

class appRoomCityModuleStatus extends TemperatureModule
{
    /**
     * appRoomCityModuleStatus is a class that extends TemperatureModule.
     * It is a custom class that is used to display the status of the city.
     *
     */
    public function __toString(){
        /**
         * This function returns the name of the class.
         */
        return "appRoomCityModuleStatus";
    }

    public function execute($listOfAllObjects){
        /**
         * This function returns the status of the city.
         */
        global $PrahaCity;
        $response = new HTTPResponse();
        $response->body = json_encode(get_object_vars($PrahaCity));
        return $response;
    }
}