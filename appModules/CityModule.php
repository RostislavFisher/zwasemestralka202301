<?php

namespace appModules;

class CityModule extends Module
{

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