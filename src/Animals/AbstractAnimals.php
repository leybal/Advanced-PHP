<?php

namespace Animals;

abstract class AbstractAnimals
{
    public  abstract  function  setMove($distance);
    public  abstract  function  getMove();
    public abstract function setName($name);
    public abstract function getName();

    function __get($property)
    {
        return $this->$property;
    }

    function __set($property, $value)
    {
        $this->$property = $value;
    }

    function __toString()
    {
        $s = '';
        $s .= 'Name: ' . $this->getName() . "<br>\n";

        return $s;
    }
}