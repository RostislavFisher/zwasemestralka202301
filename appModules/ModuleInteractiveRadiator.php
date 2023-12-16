<?php

namespace appModules;
use HTTPForm;

class ModuleInteractiveRadiator extends ModuleInteractive
{
    /**
     * ModuleInteractiveRadiator is a class that extends ModuleInteractive.
     * It is a custom class that is used to interact with the user.
     *
     */
    public $name;
    public $description;
    public $inputType;
    public $icon;
    public $value;
    public $min;
    public $max;
    public function __toString()
    {
        /**
         * This function returns the name of the class.
         */
        return "";
    }

    function execute($formData){
        /**
         * This function executes the module.
         */
        $this->setValue($formData["value"]);
    }

    function setValue($value){
        /**
         * This function sets the value of the module.
         */
        $this->value = $value;
//        change radiator physical module value here
//        using arduino/esp/raspberry pi/etc

}
}