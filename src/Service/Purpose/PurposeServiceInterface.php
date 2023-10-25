<?php

namespace App\Service\Purpose;

use App\Entity\Purpose;
use App\Model\Purpose\PurposeDto;

interface PurposeServiceInterface
{
    public function showAll();

    public function take(string $name): ?Purpose;

    public function create(PurposeDto $purposeDto): void;
}