<?php

class getMyUser
{
    public function execute($data)
    {
        global $database;
        $form = new HTTPForm($data->body);
        $cookies = $form->getAllCookies();
        $response = new HTTPResponse();
        $user =  (new authToken)->getUserByToken($cookies["authToken"]);
        if ($user == null) {
            $response->body = json_encode(array("result" => "Error", "comment" => "UserNotLoggedIn"), JSON_PRETTY_PRINT);
            return $response;
        }
        $response->body = json_encode(array("result" => "Ok", "comment" => "", "user" => $user), JSON_PRETTY_PRINT);
        return $response;

    }

}