<?php

class Templater
{
    public $file;
    public $variables;

    public function __construct($file){
        $this->file = $file;
    }

    public function render(){
        ob_start();
//        $content = file_get_contents($this->file);
        include $this->file;
        $content = ob_get_clean();
        echo $content;


        foreach ($this->variables as $key => $value) {
            $content = str_replace("{{".$key."}}", $value, $content);
        }

        return $content;

    }

}