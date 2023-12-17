<?php

/**
 * appDeleteSong is an implementation of WebEntityCustom
 * It deletes the song from the server
 */
class appDeleteSong extends WebEntityCustom
{


    /**
     * Returns the string representation of the web entity
     * @return string
     */
    public function __toString()
    {

    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data)
    {
        $songName = urldecode(urldecode($data->matches[1]));
        echo $songName;
//        get absouluete path
        $songPath = __DIR__ . "/../songs/" . $songName . ".mp3";
        unlink($songPath);
        echo $songPath;
        $response = new HTTPResponse();
        $response->body = "Song deleted";

        return $response;
    }
}