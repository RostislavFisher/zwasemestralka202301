<?php

/**
 * appMusicPlayer is an implementation of WebEntityCustom
 * It returns the music player page with the song name and path
 */
class appMusicPlayer extends WebEntityCustom
{


    /**
     * Returns the string representation of the web entity
     * @return string
     */
    public function __toString()
    {
        $templater = new Templater("musicPlayerPage/musicPlayer.html");
        $templater->variables = array(
            "title" => "Hello World",
            "content" => "Hello World"
        );
        return $templater->render();
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data)
    {
        $templater = new Templater("musicPlayerPage/musicPlayer.html");
        $templater->variables = array(
            "songName" => urldecode(urldecode($data->matches[1])),
            "songPath" => urldecode('/songs/' . urldecode($data->matches[1]) . '.mp3')
        );
        $response = new HTTPResponse();
        $response->body = $templater->render();

        return $response;
    }
}