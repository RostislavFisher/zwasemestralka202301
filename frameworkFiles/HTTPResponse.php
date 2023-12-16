<?php

class HTTPResponse
{
    /**
     * HTTPResponse is a class that defines the methods that an HTTP response should have
     * @var HeaderHTTPResponse $header: the header of the HTTP response
     * @var string $body: the body of the HTTP response
     */
    public $header;
    public $body;

    function __construct() {
        /**
         * Constructor
         */
        $this->header = new HeaderHTTPResponse();
        $this->body = "";
    }

    public function __toString() {
        /**
         * Returns the HTTP response as a string
         */
        return strval($this->header) . $this->body;


    }
}