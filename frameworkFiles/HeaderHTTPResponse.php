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
        $headerString = "";
        foreach ($this->header as $key => $value) {
            $headerString .= "$key: $value\r\n";
        }
        $headerString .= "\r\n";
        return $headerString;
    }
}
