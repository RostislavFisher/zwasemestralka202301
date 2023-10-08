<?php

class HTTPForm
{
    private $httpRequest;

    function __construct($httpRequest)
    {
        $stream = stream_get_line($httpRequest, 0, "\r\n\r\n");
        $len = intval(trim($this->parseHTTP($stream)[0]["Content-Length"]));

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

    function getBoundary(){
        echo json_encode(explode("boundary=", $this->parseHTTP($this->httpRequest)[0]["Content-Type"])[0]);
        return explode("boundary=", $this->parseHTTP($this->httpRequest)[0]["Content-Type"])[0];
    }

//    TODO: fix this function using getBoundary
//    problem:
//    1. the boundary is not used
//    2. due to point 1, the function finds POST fields + 1 wrong file field

    function getAllPOSTFields(){
        $parts = explode("------" , $this->httpRequest);
        $formData = [];
        $parts = array_slice($parts, 1);
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
            if (!empty($part)) {
                if (strpos($part, 'filename=') !== false) {
                    preg_match('/name="([^"]+)"; filename="([^"]+)"/', $part, $matches);
                    $fieldName = $matches[1];
                    $fileName = $matches[2];

                    $fileContent = substr($part, strpos($part, "\r\n\r\n"));

                    $formData[$fieldName] = [
                        'filename' => $fileName,
                        'data' => $fileContent,
                    ];
                } else {
                    preg_match('/name="([^"]+)"/', $part, $matches);
                    $fieldName = $matches[1];

                    $fieldData = explode("\r\n\r\n", $part, 2);
                    $fieldValue = $fieldData[1];

                    $formData[$fieldName] = trim($fieldValue);
                }
            }
        }
        return $formData;

    }

}