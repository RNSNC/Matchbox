<?php

namespace App\Service\Manufacturer;

use App\Entity\Manufacturer;
use App\Model\Manufacturer\ManufacturerDto;

interface ManufacturerServiceInterface
{
    public function showAll();

    public function take(string $name): ?Manufacturer;

    public function create(ManufacturerDto $manufacturerDto): void;
}