<?php

class User
{
    /**
     * User is a model class that defines a user
     * @var $id: the id of the user
     * @var $name: the name of the user
     * @var $email: the email of the user
     * @var $passwordEncrypted: the encrypted password of the user
     */
    public $id = null;
    public $name = "User";
    public $email = "";
    public $passwordEncrypted = "";
    public function __construct()
    {
        /**
         * Constructor
         */
//        echo "User class";
    }

    public function encryptPassword($password){
        /**
         * Encrypts the password
         * @param $password: the password to encrypt
         */
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function passwordMatches($password): bool{
        /**
         * Checks if the password matches
         * @param $password: the password to check
         */
        return password_verify($password, $this->passwordEncrypted);
    }

    public function create($name, $email, $password){
        /**
         * Creates a user
         * @param $name: the name of the user
         * @param $email: the email of the user
         * @param $password: the password of the user
         */
        global $database;
        $database->open();
        if(count($database->get(new User, function ($user) use ($name) {
            return $user["name"] == $name;
        })) > 0){
            echo "User already exists";
            return;
        }
        $this->name = $name;
        $this->email = $email;
        $this->passwordEncrypted = $this->encryptPassword($password);
    }

    public function save(){
        /**
         * Saves the user
         */
        return $this;
    }

    public function id()
    {
        /**
         * Returns the id of the user
         */
        global $database;
        $name = $this->name;
//        echo "name: $name\n";
        try {
            return $database->get(new User, function ($user) use ($name) {
                return $user["name"] == $name;
            })[0]["id"];
        } catch (Error $e) {
            return -1;
        }
    }



}