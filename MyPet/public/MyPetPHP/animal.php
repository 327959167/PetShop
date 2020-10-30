<?php
class animal
{
    var $id;
    var $name;
    var $type;
    var $price;
    var $sex;
    var $age;
    var $health;
    var $Favorability;

    function __construct($id, $name, $type, $price, $sex, $age, $health, $Favorability)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->sex = $sex;
        $this->age = $age;
        $this->health = $health;
        $this->Favorability = $Favorability;
    }

    function getId()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getType()
    {
        return $this->type;
    }
    function getPrice()
    {
        return $this->price;
    }
    function getSex()
    {
        return $this->sex;
    }
    function getAge()
    {
        return $this->age;
    }
    function getHealth()
    {
        return $this->health;
    }
    function getFavorability()
    {
        return $this->Favorability;
    }
}