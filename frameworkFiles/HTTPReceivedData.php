<?php

/**
 * HTTPReceivedData is a class that defines the methods that an HTTP request should have
 */
#[AllowDynamicProperties] class HTTPReceivedData
{
    /**
     * @var $url: the url of the HTTP request
     */
    public $url;
    /**
     * @var $body: the body of the HTTP request
     */
    public $body;

    /**
     * Constructor
     * @param $url: the url of the HTTP request
     * @param $body: the body of the HTTP request
     */
    function __construct($url, $body)
    {
        $this->url = $url;
        $this->body = $body;
    }

    /**
     * Returns the HTTP request as a string
     */
    function __toString()
    {
        return $this->url;
    }

    /**
     * Sets the matches of the HTTP request
     * @param $matches: the matches of the HTTP request
     */
    function setMatches(array $matches)
    {
        $this->matches = $matches;
    }
}