<?php

class UserLogin
{
    public function execute($data)
    {
        global $database;
        $database->open();
        $form = new HTTPForm($data->body);
        $formData = $form->getAllPOSTFields();
        $user = new User();
        $response = new HTTPResponse();
//        echo $formData;
        if (in_array(true, [$formData["name"]=="", $formData["password"]==""])){
            $response->body = json_encode(array("result"=>"Error", "comment"=>"Empty info"), JSON_PRETTY_PRINT);
            return $response;
        }
        $user->name = $formData["name"];
        if (count($database->get(new User, function ($user) use ($formData) {
                return $user["name"] == $formData["name"];
            })) > 0) {


            $userDatabase = $database->get(new User, function ($user) use ($formData) {
                return $user["name"] == $formData["name"];
            })[0];


            $user->passwordEncrypted = $userDatabase->passwordEncrypted;
            if(!$user->passwordMatches($formData["password"])){
                $response->body = json_encode(array("result"=>"Error", "comment"=>"WrongPassword"), JSON_PRETTY_PRINT);
                return $response;
            }

            $response->body = json_encode(array("result"=>"OK", "comment"=>""), JSON_PRETTY_PRINT);

            $authToken = new authToken();
//            echo "========". $user->id();
            $database->deleteWhere(new authToken, function ($authToken) use ($user){
                return $authToken["userID"] == $user->id();
            });
            $database->save();
            $authTokenValue = $authToken->create($user);
            $authToken = $database->add($authToken);
            $database->save();
            $response->header->header["Set-Cookie"] = "authToken=".$authTokenValue;
            return $response;
        }
        $response->body = json_encode(array("result"=>"Error", "comment"=>"UserDoesNotExist"), JSON_PRETTY_PRINT);

        return $response;

    }

}