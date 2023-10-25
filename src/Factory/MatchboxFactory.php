<?php

namespace App\Factory;

use App\Entity\Manufacturer;
use App\Entity\Matchbox;
use App\Entity\Purpose;
use App\Model\Matchbox\MatchboxDto;

class MatchboxFactory
{
    public static function build(
        MatchboxDto $matchboxDto,
        Manufacturer $manufacturer,
        Purpose $purpose
    ): Matchbox
    {
        $matchbox = new Matchbox();
        $matchbox
            ->setManufacturer($manufacturer)
            ->setPurpose($purpose)
            ->setCountMatch($matchboxDto->getCount())
            ->setLength($matchboxDto->getLength())
            ->setDescription($matchboxDto->getDescription())
        ;

        return $matchbox;
    }
}