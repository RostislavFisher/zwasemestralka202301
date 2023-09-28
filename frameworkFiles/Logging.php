<?php

class Logging
{
    public static function log($message) {
//        echo $message . "\n";
//        echo message with time
        echo '[' . date("Y-m-d H:i:s") . "] " . $message . "\n";
    }

}