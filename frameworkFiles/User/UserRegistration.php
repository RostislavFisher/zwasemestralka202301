<?php

class UserRegistration
{
    public function execute($data)
    {
        global $database;
        $database->open();
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();
        $user = new User();
        $user->name = $formData["name"];
        $response = new HTTPResponse();
        if (count($database->get(new User, function ($user) use ($formData) {
                return $user["name"] == $formData["name"];
            })) > 0) {
            $response->body = json_encode(array("result"=>"Error", "comment"=>"UserExists"), JSON_PRETTY_PRINT);
            return $response;
        }
        $user->create($formData["name"], $formData["email"], $formData["password"]);
        $database->add($user);
        $database->save();

        // Access the file data and non-file field
        $response->body = json_encode(array("result"=>"OK", "comment"=>""), JSON_PRETTY_PRINT);
        $authToken = new authToken();
        $authTokenValue = $authToken->create($user);
        $database->deleteWhere(new authToken, function ($authToken) use ($user){
            return $authToken["userID"] == $user->id();
        });
        $database->save();
        $database->add($authToken);
        $database->save();

        $response->header->header["Set-Cookie"] = "authToken=".$authTokenValue;

        return $response;

    }

}