<?php

/**
 * appListOfAllSongsPages is an implementation of WebEntityCustom
 * It returns information about the list of all songs with pagination support
 */
class appListOfAllSongsPages extends WebEntityCustom
{
    private $songsPerPage = 1; // Set the number of songs per page

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
    public function execute($data)
    {
        echo "appListOfAllSongsPages";
        $response = new HTTPResponse();
        $response->body = json_encode(array(
            "songsPerPage" => $this->songsPerPage,
            "totalPages" => $this->getTotalPages()
        ));

        return $response;
    }
}
