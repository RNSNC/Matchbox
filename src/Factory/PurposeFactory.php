<?php

namespace App\Factory;

use App\Entity\Purpose;

class PurposeFactory
{
    public static function build(string $name): Purpose
    {
        $purpose =  new Purpose();
        return $purpose->setName($name);
    }
}