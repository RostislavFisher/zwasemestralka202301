<?php

class User
{
    public $name = "User";
    public $email = "";
    public $phone = "";
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

    public function create($name, $email, $phone, $password){
        global $database;
        if(count($database->get(new User, function ($user) use ($name) {
            return $user["name"] == $name;
        })) > 0){
            echo "User already exists";
            return;
        }
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->passwordEncrypted = $this->encryptPassword($password);
    }

    public function save(){
        return $this;
    }




}