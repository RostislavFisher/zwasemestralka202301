<?php

class HTTPRequest
{
    /**
     * HTTPRequest is a class that reads socket body and returns it as a string
     * @var $url: the url of the HTTP request
     * @var $body: the body of the HTTP request
     */
    public $url;
    public $body;

    function __construct($url)
    {
        /**
         * Constructor
         * @param $url: the url of the HTTP request
         */
        $this->url = $url;
    }

    function body()
    {
        /**
         * Reads socket body and returns it as a string
         */
        $HTTPRequestHeader = new HeaderHTTPRequest();
        $HTTPRequestHeader->url =$this->url;
        $HTTPRequestHeader->header["Connection"] = "Close";
        $host = $HTTPRequestHeader->getHost();
        echo "host: $host\n";

        $fp = stream_socket_client("tcp://$host:80", $errno, $errstr, 5, STREAM_CLIENT_CONNECT);
        if (!$fp) {
            echo "error connecting to $errstr ($errno)\n";
        } else {
            $requestString = (string) $HTTPRequestHeader;
            fwrite($fp, $requestString);

            while (!feof($fp)) {
                $this->body .= fgets($fp, 4096);
            }

            fclose($fp);
        }
        return $this->body;
    }
}
