<?php
require 'vendor/autoload.php';

use Imagecow\Image;
use Imagecow\Utils\IconExtractor;
use AnthonyMartin\GeoLocation\GeoLocation as GeoLocation;

// Set locations
$edison_nj = GeoLocation::fromDegrees(40.5187154, -74.4120953);
$brooklyn_ny = GeoLocation::fromDegrees(40.65, -73.95);
echo "Distance from Edison, NJ to Brooklyn, NY: " . $edison_nj->distanceTo($brooklyn_ny,'kilometers') . " kilometers." . "<hr/>";


interface Geometry
{
    public function getValue();

    public function getMass();
}

class Paral implements Geometry
{
    protected $a;
    protected $b;
    protected $c;
    protected $density;


    public function __construct($a, $b, $c, $density)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->density = $density;
    }

    public function __toString()
    {
        return (string) ($this->getMass());
    }

    public function getMass()
    {
        return $this->getValue() * $this->density;
    }

    public function getValue()
    {
        return $this->a * $this->b * $this->c;
    }
}

class Cube extends Paral implements Geometry
{
    public function __construct($a, $density)
    {
        $this->a = $a;
        $this->b = $a;
        $this->c = $a;
        $this->density = $density;
    }

    public function __toString()
    {
        return (string) parent::__toString();
    }
}

class Sphere implements Geometry
{
    private $r;
    private $density;

    public function __construct($r, $density)
    {
        $this->r = $r;
        $this->density = $density;
    }

    public function __toString()
    {
        return (string) ($this->getMass());
    }

    public function getMass()
    {
        return $this->getValue() * $this->density;
    }

    public function getValue()
    {
        return 4 / 3 * (3.14 * $this->r * $this->r * $this->r);
    }
}

class Pyramid implements Geometry
{
    private $a;
    private $b;
    private $c;
    private $h;
    private $density;

    public function __construct($a, $b, $c, $h, $density)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->h = $h;
        $this->density = $density;
    }

    public function __toString()
    {
        return (string) ($this->getMass());
    }

    public function getMass()
    {
        return $this->getValue() * $this->density;
    }

    public function getValue()
    {
        $a = $this->a;
        $b = $this->b;
        $c = $this->c;
        $h = $this->h;
        $p = ($a + $b + $c) / 2;
        $s = sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
        return ($s * $h) / 3;
    }
}

$paral = new Paral(5, 6, 7.1, 0.1);
print "Обем и масса паралелепипеда:" . "<br/>";
print $paral->getValue() . "<br/>";
print $paral->getMass() . "<br/>";

$cube = new Cube(5, 0.1);
print "Обем и масса куба:" . "<br/>";
print $cube->getValue() . "<br/>";
print $cube->getMass() . "<br/>";

$Sphere = new Sphere(3, 0.1);
print "Обем и масса сферы:" . "<br/>";
print $Sphere->getValue() . "<br/>";
print $Sphere->getMass() . "<br/>";

$pyramid = new Pyramid(2, 3, 4, 7, 0.1);
print "Обем и масса пирамиды:" . "<br/>";
print $pyramid->getValue() . "<br/>";
print $pyramid->getMass() . "<br/>";

print "<hr/>" . "<br/>";

print "Рандомный выбор фигуры: <br/>";
$figures = array();
$figuresMass = array();
for ($j = 0; $j < 4; $j++) {
    for ($i = 0; $i < 4; $i++) {
        $figures [$j][$i] = rand(0, 3);
        switch ($figures[$j][$i]) {
            case 0:
                $figures[$j][$i] = new Paral(5, 6, 7.1, 0.1);
                $figuresMass[$j][$i] = round($figures[$j][$i]->getMass(), 1);
                break;
            case 1:
                $figures[$j][$i] = new Cube(5, 0.1);
                $figuresMass[$j][$i] = round($figures[$j][$i]->getMass(), 1);
                break;
            case 2:
                $figures[$j][$i] = new Sphere(3, 0.1);
                $figuresMass[$j][$i] = round($figures[$j][$i]->getMass(), 1);
                break;
            case 3:
                $figures[$j][$i] = new Pyramid(2, 3, 4, 7, 0.1);
                $figuresMass[$j][$i] = round($figures[$j][$i]->getMass(), 2);
                break;
        };
    }
}

$oneDArray = array();
foreach ($figuresMass as $key_j => $val_j) {
    foreach ($figuresMass[$key_j] as $key_i => $val_i) {
        array_push($oneDArray, $val_i);
        echo "| " . $val_i . " ";
    }
    echo "|" . "<br/>";
}

print "<hr/>" . "<br/>";

//Дигональная сортировка
sort($oneDArray);
$n = sizeof($figuresMass[1]) - 1;
$figuresMass[0][$n] = $oneDArray[0];
$i = 0;
$j = $n - 1;
$zsuv_j = 1;
$zsuv_i = 0;
for ($k = 1; $k < sizeof($oneDArray); $k++) {
    if ($i < $n && $j < $n && $j > 0) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        if ($i == 0) {
            $zsuv_j++;
        }
        $i++;
        $j++;
    } elseif ($i < $n && $j == $n) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        $zsuv_i++;
        $i = $i - $zsuv_i;
        $j = $j - $zsuv_j;
    } elseif ($i == 0 && $j == 0) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        $i++;
        $j++;
    } elseif ($i == $n && $j == $n) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        $i = $i - $zsuv_i;
        $j = $j - $zsuv_j;
    } elseif ($i < $n && $j == 0) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        $zsuv_i--;
        $i++;
        $j++;
    } elseif ($i == $n && $j < $n) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        $zsuv_j--;
        $i = $i - $zsuv_i;
        $j = $j - $zsuv_j;
    } elseif ($i == $n && $j == 0) {
        $figuresMass[$i][$j] = $oneDArray[$k];
        $zsuv_j--;
    } else {
        echo "Ошибка " . "[$i] [$j]" . "<br/>";
    }
}

echo "Диагональная сортировка (справа на лево): " . "<br/>";
foreach ($figuresMass as $key_j => $val_j) {
    foreach ($figuresMass[$key_j] as $key_i => $val_i) {
        echo "| " . $val_i . " ";
    }
    echo "|" . "<br/>";
}