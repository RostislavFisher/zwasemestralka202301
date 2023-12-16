<?php

class Logging
{
    /**
     * Logging is a logging class
     */
    public static function log($message) {
        /**
         * Logs a message
         * @param $message: the message to log
         */

//        echo $message . "\n";
//        echo message with time
        echo '[' . date("Y-m-d H:i:s") . "] " . $message . "\n";
    }

}