<?php

/**
 * WebEntityCustom is an abstract class for custom web entities
 */
abstract class WebEntityCustom
{

    /**
     * Returns the web entity as a string
     */
    function __toString()
    {
        return "";
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data)
    {
        return "";
    }

}