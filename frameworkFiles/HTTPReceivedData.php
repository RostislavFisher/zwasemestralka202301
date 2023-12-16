<?php

#[AllowDynamicProperties] class HTTPReceivedData
{
    /**
     * HTTPReceivedData is a class that defines the methods that an HTTP request should have
     * @var $url: the url of the HTTP request
     * @var $body: the body of the HTTP request
     */
    public $url;
    public $body;

    function __construct($url, $body)
    {
        /**
         * Constructor
         * @param $url: the url of the HTTP request
         * @param $body: the body of the HTTP request
         */
        $this->url = $url;
        $this->body = $body;
    }

    function __toString()
    {
        /**
         * Returns the HTTP request as a string
         */
        return $this->url;
    }
    function setMatches(array $matches)
    {
        /**
         * Sets the matches of the HTTP request
         * @param $matches: the matches of the HTTP request
         */
        $this->matches = $matches;
    }
}