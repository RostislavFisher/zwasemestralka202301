<?php

/**
 * appMainPage is an implementation of WebEntityCustom
 */
class appMainPage extends WebEntityCustom
{

    /**
     * returns the html code of the page
     */
    public function __toString(){
        return "<html><body>hello</body></html>";
    }

    /**
     * Executes the web entity
     * @param $listOfAllObjects: the data
     */
    function execute($listOfAllObjects)
    {
        return "<html><body>hello</body></html>";

    }
}