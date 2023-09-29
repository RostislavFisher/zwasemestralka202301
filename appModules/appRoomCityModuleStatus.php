<?php

namespace appModules;

class appRoomCityModuleStatus extends TemperatureModule
{    public function __toString(){

        return json_encode(get_object_vars($this));
    }
    public function execute($listOfAllObjects){
        global $PrahaCity;
        return json_encode(get_object_vars($PrahaCity));

    }
}