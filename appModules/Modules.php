<?php

namespace appModules;

class Modules
{
    /**
     * Modules is a class that contains a list of modules.
     *
     */
    public $modules = array();
    public function addModule(Module $Module)
    {
        /**
         * This function adds a module to the list of modules.
         */
        $this->modules[] = $Module;
    }
}