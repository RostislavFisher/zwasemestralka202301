<?php
/**
 * appUserRegistration is an implementation of WebEntityCustom
 * It registers a user
 */

class appUserRegistration extends WebEntityCustom
{

    /**
     * Executes the web entity
     * @param $data: the data
     */    function execute($data)
    {
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();
        echo json_encode($formData, JSON_PRETTY_PRINT);
    }
}