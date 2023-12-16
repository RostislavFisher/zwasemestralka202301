<?php

/**
 * appRoomModuleInteractiveSetValue is a class that changes TemperatureModule value.
 *
 */
class appRoomModuleInteractiveSetValue
{
    /**
     * This function returns the name of the class.
     */
    public function __toString(){
        return "appRoomModuleInteractiveSetValue";
    }
    /**
     * This function changes TemperatureModule value.
     */
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