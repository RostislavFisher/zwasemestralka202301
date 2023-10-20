<?php

namespace appModules;
use HTTPForm;

class ModuleInteractiveRadiator extends ModuleInteractive
{
    public $name;
    public $description;
    public $inputType;
    public $icon;
    public $value;
    public $min;
    public $max;
    public function __toString()
    {
        return "";
    }

    function execute($formData){
        $this->setValue($formData["value"]);
    }

    function setValue($value){
        $this->value = $value;
//        change radiator physical module value here
//        using arduino/esp/raspberry pi/etc

}
}