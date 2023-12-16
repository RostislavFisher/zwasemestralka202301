<?php

class appRoomModuleInteractiveSetValue
{
    /**
     * appRoomModuleInteractiveSetValue is a class that changes TemperatureModule value.
     *
     */
    public function __toString(){
        /**
         * This function returns the name of the class.
         */
        return "appRoomModuleInteractiveSetValue";
    }
    public function execute($listOfAllObjects){
        /**
         * This function changes TemperatureModule value.
         */
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