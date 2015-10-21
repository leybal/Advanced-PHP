<?php

require_once 'vendor/autoload.php';

use Animals\Dog;
use Animals\Fish;

$dog = new Dog();
$dog->setName('Duke');
$dog->setMove('101');
print $dog->__toString() . "<br>\n";


$fish = new Fish();
$fish->setName('Gold fish');
$fish->setMove('10');
echo $fish->__toString();