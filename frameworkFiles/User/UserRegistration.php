<?php

/**
 * UserRegistration is an implementation of WebEntityCustom
 * It registers a user
 */
class UserRegistration extends WebEntityCustom
{
    /**
     * Executes the web entity
     * @param $data: the data
     */
    public function execute($data)
    {
        global $database;
        $database->open();
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();
        $user = new User();
        $response = new HTTPResponse();

        echo $formData["email"];
        if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
            $response->body = json_encode(array("result"=>"Error", "comment"=>"InvalidEmail"), JSON_PRETTY_PRINT);
            return $response;
        }

        if (in_array(true, [$formData["name"]=="", $formData["email"]=="", $formData["password"]==""])){
            $response->body = json_encode(array("result"=>"Error", "comment"=>"Empty info"), JSON_PRETTY_PRINT);
            return $response;
        }
        $user->name = $formData["name"];
        if (count($database->get(new User, function ($user) use ($formData) {
                return $user["name"] == $formData["name"];
            })) > 0) {
            $response->body = json_encode(array("result"=>"Error", "comment"=>"UserExists"), JSON_PRETTY_PRINT);
            return $response;
        }
        $user->create($formData["name"], $formData["email"], $formData["password"]);
        $user = $database->add($user);
        $database->save();

        // Access the file data and non-file field
        $response->body = json_encode(array("result"=>"OK", "comment"=>""), JSON_PRETTY_PRINT);
        $authToken = new authToken();
        $authTokenValue = $authToken->create($user);
        $database->deleteWhere(new authToken, function ($authToken) use ($user){
            return $authToken["userID"] == $user["id"];
        });
        $authToken =$database->add($authToken);
        $database->save();

        $response->header->header["Set-Cookie"] = "authToken=".$authTokenValue;

        return $response;

    }

}