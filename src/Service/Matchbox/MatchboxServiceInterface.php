<?php

namespace App\Service\Matchbox;

use App\Entity\Matchbox;
use App\Model\Matchbox\MatchboxDto;
use App\Model\Matchbox\MatchboxDtoList;

interface MatchboxServiceInterface
{
    public function showOne(Matchbox $matchbox): MatchboxDto;

    public function showAll(): MatchboxDtoList;

    public function create(MatchboxDto $matchboxDto): void;
}