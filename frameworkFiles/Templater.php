<?php

class Templater
{
    /**
     * Templtater is a class that renders a template file
     */
    public $file;
    public $variables = [];

    public function __construct($file){
        /**
         * Constructor
         * @param $file: the template file
         */
        $this->file = $file;
    }

    public function render(){
        /**
         * Renders the template file
         */
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