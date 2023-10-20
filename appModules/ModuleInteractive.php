<?php

namespace appModules;

class ModuleInteractive extends Module
{
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
        $this->setValue($formData["value"]);
        echo json_encode($formData, JSON_PRETTY_PRINT);
    }

    function setValue($value){
        echo "Setting value to " . $value;
//        execute
    }




}
