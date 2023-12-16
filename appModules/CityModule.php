<?php

namespace appModules;

/**
CityModule is a class that extends Module.
It is a custom class that is used to display the status of the city.
 *
 */
class CityModule extends Module
{
    /**
     * returns the object as a string.
     */
    public function __toString(){

        return json_encode(get_object_vars($this));
    }

    /**
     * returns the status of the module.
     */
    public function execute($listOfAllObjects){

    }

    /**
     * updates the value of the module.
     */
    public function update($value){
        $this->value = $value;
    }

    /**
     * updates the value of the module using the API.
     */
    public function updateUsingAPI(){
        $this->value = random_int(0, 30);
    }

}