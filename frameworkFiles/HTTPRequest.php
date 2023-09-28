<?php

class HTTPRequest
{
    public $url;
    public $body;

    function __construct($url)
    {
        $this->url = $url;
    }

    function body()
    {
        $HTTPRequest = new HeaderHTTPRequest();
        $HTTPRequest->url = $this->url;
        $host = $HTTPRequest->getHost();
        echo "host: $host\n";

        $fp = stream_socket_client("tcp://$host:80", $errno, $errstr, 5, STREAM_CLIENT_CONNECT);
        if (!$fp) {
            echo "error connecting to $errstr ($errno)\n";
        } else {
            $requestString = (string) $HTTPRequest;
            fwrite($fp, $requestString);

            while (!feof($fp)) {
                $this->body .= fgets($fp, 4096);
            }

            fclose($fp);
        }
        return $this->body;
    }
}
