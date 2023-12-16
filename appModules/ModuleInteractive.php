<?php

namespace appModules;

class ModuleInteractive extends Module
{
    /**
     * ModuleInteractive is a class that extends Module.
     * It is a custom class that is used to interact with the user.
     *
     */
    public $name;
    public $description;
    public $inputType;
    public $icon;
    public $value;
    public function __toString()
    {
        return "";
    }

    function execute($formData){
        /**
         * This function executes the module.
         */
        $this->setValue($formData["value"]);
        echo json_encode($formData, JSON_PRETTY_PRINT);
    }

    function setValue($value){
        /**
         * This function sets the value of the module.
         */
        echo "Setting value to " . $value;
//        execute
    }




}
