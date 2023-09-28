<?php
class appMusicPlayer extends WebEntityCustom
{

    public function __toString()
    {
        $templater = new Templater("musicPlayerPage/musicPlayer.html");
        $templater->variables = array(
            "title" => "Hello World",
            "content" => "Hello World"
        );
        return $templater->render();
    }

    function execute($listOfAllObjects)
    {
        $templater = new Templater("musicPlayerPage/musicPlayer.html");
        $templater->variables = array(
            "songName" => urldecode("$listOfAllObjects[1]"),
            "songPath" => urldecode('/songs/'."$listOfAllObjects[1].mp3"),
        );
        return $templater->render();
    }
}