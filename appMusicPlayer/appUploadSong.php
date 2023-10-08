<?php

class appUploadSong
{
    function execute($data)
    {
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();

        echo json_encode($formData, JSON_PRETTY_PRINT);

        // Access the file data and non-file field
        $fileData = $formData['song']['data'];
        $fileData = str_replace(' ', '+', $fileData);
        $nonFileField = $formData['songName'];
        file_put_contents("songs/" . $nonFileField . ".mp3", $formData['song']['data']);
        $response = new HTTPResponse();
        $response->body = json_encode($formData, JSON_PRETTY_PRINT);

        return $response;

    }

}