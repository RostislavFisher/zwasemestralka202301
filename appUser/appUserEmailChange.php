<?php
/**
 * appUserEmailChange is an implementation of WebEntityCustom
 * It changes the email of a user
 */

class appUserEmailChange extends WebEntityCustom
{

    /**
     * Executes the web entity
     * @param $data: the data
     */
    function execute($data){
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();
        $email = $formData['newEmail'];
        $username = $formData['username'];
        echo $email;
        echo $username;
        try{
            global $database;
            $database->open();
            $user = $database->get(new User, function ($user) use ($username) {
                return $user["name"] == $username;
            })[0];
            echo $user->email;
            $database->edit($user, "email", $email);

            $database->save();
            $response = new HTTPResponse();
//            $response->body = json_encode("Success");
            echo $response->body;
            return $response;
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
            $response = new HTTPResponse();
//            $response->body = json_encode("Error");
            return $response;
        }


}
}