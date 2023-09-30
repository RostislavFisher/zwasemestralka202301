<?php

#[AllowDynamicProperties] class HTTPReceivedData
{
    public $url;
    public $body;

    function __construct($url, $body)
    {
        $this->url = $url;
        $this->body = $body;
    }

    function __toString()
    {
        return $this->url;
    }
    function setMatches(array $matches)
    {
        $this->matches = $matches;
    }
}