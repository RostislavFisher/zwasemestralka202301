<?php

class Templater
{
    public $file;
    public $variables;

    public function __construct($file){
        $this->file = $file;
    }

    public function render(){
        $content = file_get_contents($this->file);
        foreach ($this->variables as $key => $value) {
            $content = str_replace("{{".$key."}}", $value, $content);
        }

        return $content;

    }

}