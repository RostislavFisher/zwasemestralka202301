<?php

/**
 * authToken is a class for auth tokens
 */
class authToken
{
    /**
     * @var $id: the id of the auth token in the database
     */
    public $id;
    /**
     * @var $userID: the id of the user
     */
    public $userID;
    /**
     * @var $token: the token
     */
    public $token;
    /**
     * @var $expires: the time the token expires
     */
    public $expires;

    /**
     * Creates a new auth token
     * @param $user: the user object
     */
    public function create($user){
        $this->userID = $user->id;
        $this->token = bin2hex(random_bytes(32));
        $this->expires = time() + 3600;
        return $this->token;
    }

    /**
     * Returns the user associated with the token
     * @param $authToken: the token
     */
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