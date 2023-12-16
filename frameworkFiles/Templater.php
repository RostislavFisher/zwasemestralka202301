<?php

/**
 * Templtater is a class that renders a template file
 */
class Templater
{
    /**
     * @var $file : the template file path
     */
    public $file;
    /**
     * @var $variables : the variables
     */
    public $variables = [];

    /**
     * Constructor
     * @param $file: the template file
     */
    public function __construct($file){
        $this->file = $file;
    }

    /**
     * Renders the template file
     */
    public function render(){
        ob_start();
//        $content = file_get_contents($this->file);
        include $this->file;
        $content = ob_get_clean();

        foreach ($this->variables as $key => $value) {
            $content = str_replace("{{".$key."}}", $value, $content);
        }

        return $content;

    }

}