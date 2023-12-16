<?php

namespace appModules;
use HTTPForm;

/**
 * ModuleInteractiveRadiator is a class that extends ModuleInteractive.
 * It is a custom class that is used to interact with the user.
 *
 */
class ModuleInteractiveRadiator extends ModuleInteractive
{
    /**
     * @var string $name is the name of the module.
     */
    public $name;
    /**
     * @var string $description is the description of the module.
     */
    public $description;
    /**
     * @var string $inputType is the input type of the module.
     */
    public $inputType;
    /**
     * @var string $icon is the icon of the module.
     */
    public $icon;
    /**
     * @var string $value is the value of the module.
     */
    public $value;
    /**
     * @var string $min is the minimum value of the module.
     */
    public $min;
    /**
     * @var string $max is the maximum value of the module.
     */
    public $max;

    /**
     * This function returns the name of the class.
     */
    public function __toString()
    {
        return "";
    }

    /**
     * This function executes the module.
     */
    function execute($formData){
        $this->setValue($formData["value"]);
    }

    /**
     * This function sets the value of the module.
     */
    function setValue($value){
        $this->value = $value;
//        change radiator physical module value here
//        using arduino/esp/raspberry pi/etc

}
}