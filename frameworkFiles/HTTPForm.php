<?php

class HTTPForm
{
    private $httpRequest;

    function __construct($httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    function parseHTTP() {
        $formFields = [];
        $formData = explode("------", $this->httpRequest);

        foreach ($formData as $formDataPart) {
            $formDataPart = trim($formDataPart);

            if (!empty($formDataPart)) {
                $lines = explode("\n", $formDataPart);
                $formItem = [];

                foreach ($lines as $line) {
                    list($key, $value) = explode(": ", $line, 2);
                    $formItem[trim($key)] = trim($value);
                }

                $formFields[] = $formItem;
            }
        }

        return $formFields;
    }

    function getBoundary(){
        return explode("boundary=", $this->parseHTTP()[0]["Content-Type"])[1];
    }

    function getAllPOSTFields(){
        $parts = explode("--" . $this->getBoundary(), $this->httpRequest);
        foreach ($parts as $part) {
            if (!empty($part)) {
                if (strpos($part, 'filename=') !== false) {
                    preg_match('/name="([^"]+)"; filename="([^"]+)"/', $part, $matches);
                    $fieldName = $matches[1];
                    $fileName = $matches[2];
                    echo json_encode($matches, JSON_PRETTY_PRINT);
                    echo $part . "\n";

                    // Extract the file content
                    $fileContent = substr($part, strpos($part, "\r\n\r\n"));

                    $formData[$fieldName] = [
                        'filename' => $fileName,
                        'data' => $fileContent,
                    ];
                } else {
                    preg_match('/name="([^"]+)"/', $part, $matches);
                    $fieldName = $matches[1];

                    // Extract the field data
                    $fieldData = explode("\r\n\r\n", $part, 2);
                    $fieldValue = $fieldData[1];

                    $formData[$fieldName] = trim($fieldValue);
                }
            }
        }
        return $formData;

    }

}