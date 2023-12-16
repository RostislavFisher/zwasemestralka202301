<?php

namespace appModules;

class CityModule extends Module
{
    /**
     CityModule is a class that extends Module.
     It is a custom class that is used to display the status of the city.
     *
     */

    public function __toString(){

        return json_encode(get_object_vars($this));
    }
    public function execute($listOfAllObjects){

    }

    public function update($value){
        $this->value = $value;
    }

    public function updateUsingAPI(){
        $this->value = random_int(0, 30);
    }

}