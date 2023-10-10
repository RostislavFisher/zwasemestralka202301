<?php
class appUserRegistration extends WebEntityCustom
{
    function execute($data)
    {
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();
        echo json_encode($formData, JSON_PRETTY_PRINT);
    }
}