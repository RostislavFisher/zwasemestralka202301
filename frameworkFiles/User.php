<?php

class User
{
    public $id = null;
    public $name = "User";
    public $email = "";
    public $passwordEncrypted = "";
    public function __construct()
    {
//        echo "User class";
    }

    public function encryptPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function passwordMatches($password): bool{
        return password_verify($password, $this->passwordEncrypted);
    }

    public function create($name, $email, $password){
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
        return $this;
    }

    public function id()
    {
        global $database;
        $name = $this->name;
        echo "name: $name\n";
        try {
            echo json_encode($database->get(new User, function ($user) use ($name) {
                return $user["name"] == $name;
            }), JSON_PRETTY_PRINT);
            return $database->get(new User, function ($user) use ($name) {
                return $user["name"] == $name;
            })[0]["id"];
        } catch (Error $e) {
            return -1;
        }
    }



}