<?php

namespace App\Service\Manufacturer;

use App\Entity\Manufacturer;
use App\Factory\ManufacturerFactory;
use App\Model\Manufacturer\ManufacturerDto;
use App\Model\Manufacturer\ManufacturerDtoList;
use App\Repository\ManufacturerRepository;

class ManufacturerService implements ManufacturerServiceInterface
{
    public function __construct(
        private readonly ManufacturerRepository $repository
    ){}

    private function transform(Manufacturer $manufacturer): ManufacturerDto
    {
        return ManufacturerDto::build(
            $manufacturer->getId(),
            $manufacturer->getName(),
        );
    }

    public function showAll(): ManufacturerDtoList
    {
        $manufactures = $this->repository->findAll();

        return ManufacturerDtoList::build(
            array_map([$this, 'transform'], $manufactures)
        );
    }

    public function take(string $name): ?Manufacturer
    {
        return $this->repository->findOneBy([
            'name' => $name
        ]);
    }

    public function create(ManufacturerDto $manufacturerDto): void
    {
        $manufacturer = ManufacturerFactory::build($manufacturerDto->getName());

        $this->repository->add($manufacturer, true);
    }
}