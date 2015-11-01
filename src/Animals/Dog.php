<?php

namespace Animals;

class Dog extends AbstractAnimals
{
    protected $distance;
    protected $name;

    /**
     * @param $distance
     */
    public function  setMove($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function  getMove()
    {
        return $this->distance;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    function __toString()
    {
        $s = parent::__toString();
        $s .= $this->getName() . ' ran ' . $this->getMove() . ' meters.' . "<br>\n";

        return $s;
    }


}