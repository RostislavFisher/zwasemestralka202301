<?php

/**
 * HTTPForm is a class that parses the HTTP request and returns the form data
 */
class HTTPForm
{
    /**
     * @var mixed $httpRequest: the HTTP request
     */
    private $httpRequest;
    /**
     * @var array $httpHeaders: the HTTP headers
     */
    private $httpHeaders = [];
    /**
     * @var array $formData: the form data
     */
    private $formData = [];

    /**
     * Constructor
     * @param $httpRequest: the HTTP request
     */
    function __construct($httpRequest)
    {
        $stream = stream_get_line($httpRequest, 0, "\r\n\r\n");
        try{
//            $http = $this->parseHTTP($stream);
//            $httpValues = $http[0];
            $httpValues = $this->parseHTTP($stream)[0];
            $this->httpHeaders = $httpValues;
            if (!array_key_exists("Content-Length", $httpValues)) {
                throw new Error("Content-Length is not set\n");
            }
            $len = intval(trim($httpValues["Content-Length"]));
        }
        catch (Error $e){
            echo "Error: " . $e->getMessage();
            $this->httpRequest = $stream;
            return;
        }
        $dataValue = '';
        $calculate = 0;
        while (!feof($httpRequest)) {
            $dataChunk = stream_get_contents($httpRequest, $len-strlen($dataValue));
            if ($dataChunk === false || strlen($dataChunk) === 0) {
                break;
            }

            $calculate++;
            $dataValue .= $dataChunk;
        }
        $this->httpRequest = $dataValue;


    }

    /**
     * Parses the HTTP request
     * @param $httpRequest: the HTTP request
     */
    function parseHTTP($httpRequest) {
        $formFields = [];
        $formData = explode("\r\n\r\n", $httpRequest);
        $formDataPart = trim($formData[0]);

        $lines = explode("\n", $formDataPart);
        $formItem = [];
//        echo json_encode($lines, JSON_PRETTY_PRINT) . "\n";
//        foreach ($lines as $line) {
//            echo "line: $line\n";
////            echo json_encode(explode(": ", $line, 2), JSON_PRETTY_PRINT) . "\n";
//            list($key, $value) = explode(": ", $line, 2);
//            echo "key: $key, value: $value\n";
//            $formItem[$key] = $value;
//        }
//        same with for loop
        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];
            $parts = explode(": ", $line, 2);
            if (isset($parts[1])) {
                $key = $parts[0];
                $value = $parts[1];
                $formItem[$key] = $value;
            }

        }


        $formFields[] = $formItem;

        return $formFields;
    }

    /**
     * Returns all POST fields
     */
    function getAllPOSTFields(){
        $boundary = explode("boundary=", $this->httpHeaders["Content-Type"])[1];
//        $parts = explode($boundary , $this->httpRequest);
//        $parts = array_slice($parts, 1, count($parts)-1);
        $parts = explode("------" , $this->httpRequest);
        array_pop($parts);
        array_shift($parts);
        $this->formData = [];
//        $parts = array_slice($parts, 1);
//        foreach ($parts as $part) {
//            if (!empty($part)) {
//                if (strpos($part, 'filename=') !== false) {
//                    preg_match('/name="([^"]+)"; filename="([^"]+)"/', $part, $matches);
//                    $fieldName = $matches[1];
//                    $fileName = $matches[2];
//
//                    $fileContent = substr($part, strpos($part, "\r\n\r\n"));
//
//                    $formData[$fieldName] = [
//                        'filename' => $fileName,
//                        'data' => $fileContent,
//                    ];
//                } else {
//                    preg_match('/name="([^"]+)"/', $part, $matches);
//                    $fieldName = $matches[1];
//
//                    $fieldData = explode("\r\n\r\n", $part, 2);
//                    $fieldValue = $fieldData[1];
//
//                    $formData[$fieldName] = trim($fieldValue);
//                }
//            }
//        }
//        same with for loop
        for ($i = 0; $i < count($parts); $i++) {
            $part = $parts[$i];
//            $part = explode("--", $parts[$i])[0];
            if (!empty($part)) {
                if (strpos($part, 'filename=') !== false) {
                    preg_match('/name="([^"]+)"; filename="([^"]+)"/', $part, $matches);
                    $fieldName = $matches[1];
                    $fileName = $matches[2];

                    $fileContent = substr($part, strpos($part, "\r\n\r\n"));

                    $this->formData[$fieldName] = [
                        'filename' => $fileName,
                        'data' => $fileContent,
                    ];
                } else {
                    preg_match('/name="([^"]+)"/', $part, $matches);
                    $fieldName = $matches[1];

                    $fieldData = explode("\r\n\r\n", $part, 2);
                    $fieldValue = $fieldData[1];

                    $this->formData[$fieldName] = trim($fieldValue);
                }
            }
        }
        return $this->formData;

    }

    /**
     * Returns all cookies
     */
    function getAllCookies(){
//        TODO: fix bug with multi cookies
        $httpRequest = $this->parseHTTP($this->httpRequest)[0];
        if (!array_key_exists("Cookie", $httpRequest)) {
            return [];
        }
        $Cookies = $httpRequest["Cookie"];
        $CookiesList = explode(";", $Cookies);
        $CookiesList = array_map(function ($cookie) {
            $cookie = explode("=", $cookie);
            return array($cookie[0] => $cookie[1]);
        }, $CookiesList);
        $CookiesList = array_reduce($CookiesList, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);

        return $CookiesList;
    }

}