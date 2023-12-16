<?php

/**
 * HTTPResponse is a class that defines the methods that an HTTP response should have
 */
class HTTPResponse
{
    /**
     * @var HeaderHTTPResponse $header: the header of the HTTP response
     */
    public $header;
    /**
     * @var string $body: the body of the HTTP response
     */
    public $body;

    /**
     * Constructor
     */
    function __construct() {
        $this->header = new HeaderHTTPResponse();
        $this->body = "";
    }

    /**
     * Returns the HTTP response as a string
     */
    public function __toString() {
        return strval($this->header) . $this->body;


    }
}