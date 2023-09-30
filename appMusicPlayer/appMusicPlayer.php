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

    function execute($data)
    {
        $templater = new Templater("musicPlayerPage/musicPlayer.html");
        $templater->variables = array(
            "songName" => urldecode(urldecode($data->matches[1])),
            "songPath" => urldecode('/songs/' . urldecode($data->matches[1]) . '.mp3')
        );
        return $templater->render();
    }
}