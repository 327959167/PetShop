<?php
class Master
{
    public $name;
    var $money;
    var $username;
    var $password;
    var $pet;

    function __construct($name, $money, $username, $password)
    {
        $this->name = $name;
        $this->money = $money;
        $this->username = $username;
        $this->password = $password;
    }

    function setPet($pet)
    {
        $this->pet = $pet;
    }
    function getPet()
    {
        return $this->pet;
    }

    function getName()
    {
        return $this->name;
    }

    function getMoney()
    {
        return $this->money;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }
}