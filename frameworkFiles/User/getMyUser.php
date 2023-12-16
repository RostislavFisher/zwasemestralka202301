<?php

/**
 * getMyUser is an implementation of WebEntityCustom
 * It returns the user of the current session
 */
class getMyUser
{
    /**
     * Executes the web entity
     * @param $data: the data
     */
    public function execute($data)
    {
        global $database;
        $form = new HTTPForm($data->body);
        $cookies = $form->getAllCookies();
        $response = new HTTPResponse();
        if (!(array_key_exists("authToken", $cookies))){
            $response->body = json_encode(array("result" => "Error", "comment" => "UserNotLoggedIn",), JSON_PRETTY_PRINT);
            return $response;

        }
        $user =  (new authToken)->getUserByToken($cookies["authToken"]);
        if ($user == null) {
            $response->body = json_encode(array("result" => "Error", "comment" => "UserNotLoggedIn"), JSON_PRETTY_PRINT);
            return $response;
        }
        $response->body = json_encode(array("result" => "Ok", "comment" => "", "user" => $user), JSON_PRETTY_PRINT);
        return $response;

    }

}