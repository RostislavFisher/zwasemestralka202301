<?php

class HeaderHTTPResponse
{
    public $header = array(
        "HTTP/1.1"=>"200 OK",
        "Server"=>"rostislavfisherPHPServer",
    );

    public function __toString() {
        $headerString = "";
        foreach ($this->header as $key => $value) {
            $headerString .= "$key: $value\r\n";
        }
        $headerString .= "\r\n";
        return $headerString;
    }
}
