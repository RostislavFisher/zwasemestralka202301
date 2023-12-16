<?php

namespace appModules;

/**
 * ModuleInteractive is a class that extends Module.
 * It is a custom class that is used to interact with the user.
 *
 */
class ModuleInteractive extends Module
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
     * This function returns the string representation of the class.
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
        echo json_encode($formData, JSON_PRETTY_PRINT);
    }

    /**
     * This function sets the value of the module.
     */
    function setValue($value){
        echo "Setting value to " . $value;
//        execute
    }




}
