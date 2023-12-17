<?php

/**
 * appListOfAllSongs is an implementation of WebEntityCustom
 * It returns the list of all songs
 */
class appListOfAllSongs extends WebEntityCustom
{

    /**
     * Returns the string representation of the web entity
     * @return string
     */
    public function __toString(){
        $files = array_diff(scandir(getcwd().'songs'), array('.', '..'));
        $listOfSongs = array();

        foreach ($files as $file) {
            $song = new Song();
            $song->songName = explode(".", $file)[0];
            $song->songPath = "songs\\$file";
            $song->songDuration = "";
            array_push($listOfSongs, $song);
        }
        return json_encode($listOfSongs);
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    public function execute($listOfAllObjects)
    {
        $files = array_diff(scandir(getcwd().'\songs'), array('.', '..'));
        $listOfSongs = array();

        foreach ($files as $file) {
            $song = new Song();
            $song->songName = explode(".", $file)[0];
            $song->songPath = "songs\\$file";
            $song->songDuration = "";
            array_push($listOfSongs, $song);
        }
        $response = new HTTPResponse();
        $response->body = json_encode($listOfSongs);

        return $response;
    }
}