<?php
/**
 * Logging is a logging class
 */
class Logging
{
    /**
     * Logs a message
     * @param $message: the message to log
     */
    public static function log($message) {

//        echo $message . "\n";
//        echo message with time
        echo '[' . date("Y-m-d H:i:s") . "] " . $message . "\n";
    }

}