<?php

/**
 * appListOfSongsByPage is an implementation of WebEntityCustom
 * It returns the list of all songs with pagination support
 */
class appListOfSongsByPage extends WebEntityCustom
{
    private $songsPerPage = 1;

    /**
     * Get the total number of pages
     *
     * @return int
     */
    public function getTotalPages()
    {
        $files = array_diff(scandir(getcwd() . '\songs'), array('.', '..'));
        $totalSongs = count($files);
        $totalPages = ceil($totalSongs / $this->songsPerPage);
        return $totalPages;
    }

    /**
     * Get songs for a specific page
     *
     * @param int $page
     * @return string JSON representation of songs for the page
     */
    public function getSongsForPage($page)
    {
        $files = array_diff(scandir(getcwd() . '\songs'), array('.', '..'));
        $listOfSongs = array();
        $startIdx = ($page - 1) * $this->songsPerPage;
        $endIdx = $startIdx + $this->songsPerPage;

        $files = array_slice($files, $startIdx, $this->songsPerPage);

        foreach ($files as $file) {
            $song = new Song();
            $song->songName = explode(".", $file)[0];
            $song->songPath = "songs\\$file";
            array_push($listOfSongs, $song);
        }

        return $listOfSongs;
    }

    /**
     * Returns the string representation of the web entity
     * @return string
     */
    public function __toString()
    {
        return $this->getSongsForPage(1);
    }

    /**
     * Executes the web entity
     * @param $data: the data
     */
    public function execute($data)
    {
        $page = urldecode(urldecode($data->matches[1]));
        $songs = $this->getSongsForPage(intval($page));
        $response = new HTTPResponse();
        $response->body = json_encode(array(
            "songs" => $songs
        ));

        return $response;
    }
}