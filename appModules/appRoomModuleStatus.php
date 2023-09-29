<?php

namespace appModules;

class appRoomModuleStatus extends TemperatureModule
{    public function __toString(){

        return json_encode(get_object_vars($this));
    }
    public function execute($listOfAllObjects){
        global $AllModules;
        return json_encode(get_object_vars($AllModules));

    }
}