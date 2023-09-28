<?php

class HTTPResponse
{
    public $header;
    public $body;

    function __construct() {
        $this->header = new HeaderHTTPResponse();
        $this->body = "";
    }

    public function __toString() {
        return strval($this->header) . $this->body;


    }
}