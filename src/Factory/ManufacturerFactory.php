<?php

namespace App\Factory;

use App\Entity\Manufacturer;

class ManufacturerFactory
{
    public static function build(string $name): Manufacturer
    {
        $purpose =  new Manufacturer();
        return $purpose->setName($name);
    }
}