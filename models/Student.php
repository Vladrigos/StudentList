<?php

class Student
{
    private $gender;
    private $name;
    private $surname;
    private $group;
    private $email;
    private $points;
    private $local;
    private $cookie;
    
    public function __construct($name, $surname, $group, $points, $email = null, $local = null, $gender = null, $cookie = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->group = $group;
        $this->points = $points;
        $this->gender = $gender;
        $this->local = $local;
        $this->email = $email;
        $this->cookie = $cookie;
    }
    
    public function getGender()
    {
        return $this->gender;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getSurname()
    {
        return $this->surname;
    }
    
    public function getGroup()
    {
        return $this->group;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPoints()
    {
        return $this->points;
    }
    
    public function getLocal()
    {
        return $this->local;
    }
    
    public function getCookie()
    {
        return $this->cookie;
    }
    
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    
    public function setGroup($group)
    {
        $this->group = $group;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }
    
    public function setLocal($location)
    {
        $this->local = $local;
    }
    
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }
    
}