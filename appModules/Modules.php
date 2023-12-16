<?php

namespace appModules;

/**
 * Modules is a class that contains a list of modules.
 *
 */
class Modules
{
    /**
     * @var array $modules is the list of modules.
     */
    public $modules = array();
    /**
     * This function adds a module to the list of modules.
     */
    public function addModule(Module $Module)
    {
        $this->modules[] = $Module;
    }
}