<?php

 

class User{
    
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $phonenumber;
    private $street;
    private $city;
    private $role;


    public function __construct($id, $name, $surname, $email, $password, $phonenumber, $street, $city, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->phonenumber = $phonenumber;
        $this->street = $street;
        $this->city = $city;
        $this->role = $role;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getPhoneNumber(){
        return $this->phonenumber;
    }

    public function getStreet(){
        return $this->street;
    }

    public function getCity(){
        return $this->city;
    }

    public function getRole(){
        return $this->role;
    }



    



}