<?php

class authToken
{
    public $id;
    public $userID;
    public $token;
    public $expires;
    public function create($user){
        $this->userID = $user->id;
        $this->token = bin2hex(random_bytes(32));
        $this->expires = time() + 3600;
        return $this->token;
    }

    public function getUserByToken($authToken){
        global $database;
        $database->open();
        $token = $database->get(new authToken, function ($token) use ($authToken) {
            return $token["token"] == $authToken;
        });
        if(count($token) == 0){
            return null;
        }
        $token = $token[0];
//        TODO: fix expires
//        if($token["expires"] < time()){
//            return null;
//        }
        return $database->get(new User, function ($user) use ($token) {
            return $user["id"] == $token->userID;
        })[0];
    }

}