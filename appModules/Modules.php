<?php

namespace appModules;

class Modules
{
    public $modules = array();
    public function addModule(Module $Module)
    {
        $this->modules[] = $Module;
    }
}