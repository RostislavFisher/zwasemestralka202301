<?php

/**
 * HeaderHTTPResponse is a class that defines the methods that an HTTP response should have
 * @var array $header: the header of the HTTP response
 */
class HeaderHTTPResponse
{
    /**
     * @var array $header: the header of the HTTP response
     */
    public $header = array(
        "HTTP/1.1"=>"200 OK",
        "Server"=>"rostislavfisherPHPServer",
    );

    /**
     * Returns the HTTP response as a string
     */
    public function __toString() {
        $HTTPCode = $this->header["HTTP/1.1"];
        $headers = $this->header;
        array_shift($headers);
        $headerString = "HTTP/1.1 $HTTPCode\r\n";
        foreach ($headers as $key => $value) {
            $headerString .= "$key: $value\r\n";
        }
        $headerString .= "\r\n";
        return $headerString;
    }
}
