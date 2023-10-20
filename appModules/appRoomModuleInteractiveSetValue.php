<?php

class appRoomModuleInteractiveSetValue
{
    public function __toString(){
        return "appRoomModuleInteractiveSetValue";
    }
    public function execute($listOfAllObjects){
        global $AllModules;
        $response = new HTTPResponse();
        $listOfModules = [];
        $form = new HTTPForm($listOfAllObjects->body);
        $formData = $form->getAllPOSTFields();
        echo json_encode($formData, JSON_PRETTY_PRINT);
        foreach ($AllModules->modules as $module){
            echo $module->name;
            if($module->name == $formData["name"]){
                $module->execute($formData);
            }
        }
        $response->body = json_encode($listOfModules);

        return $response;

    }

}