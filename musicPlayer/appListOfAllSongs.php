<?php
class appListOfAllSongs extends WebEntityCustom
{
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
        return json_encode($listOfSongs);
    }
}