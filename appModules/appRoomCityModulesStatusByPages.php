<?php

class appRoomCityModulesStatusByPages extends WebEntityCustom
{

    public function execute($listOfAllObjects){
//        get all modules of type appModules\\RoomTemperatureModule
        global $AllModules;
//        $data->matches[1]; // this is the id of the module
        $listOfAllRoomTemperatureModules = array();
        foreach ($AllModules->modules as $module){
            if (is_a($module, "appModules\\RoomTemperatureModule")){
                $listOfAllRoomTemperatureModules[] = $module;
            }
        }
        echo json_encode($listOfAllRoomTemperatureModules);
        $templater = new Templater("smarthouse/TemperatureModule.html");
        $templater->variables = array(
            "Name" => $listOfAllRoomTemperatureModules[0]->name,
            "Value" => $listOfAllRoomTemperatureModules[0]->value,
        );
        $response = new HTTPResponse();
        $response->body = $templater->render();

        return $response;



    }
}