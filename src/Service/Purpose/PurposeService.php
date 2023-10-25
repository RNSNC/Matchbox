<?php

namespace App\Service\Purpose;

use App\Entity\Purpose;
use App\Factory\PurposeFactory;
use App\Model\Purpose\PurposeDto;
use App\Model\Purpose\PurposeDtoList;
use App\Repository\PurposeRepository;

class PurposeService implements PurposeServiceInterface
{
    public function __construct(
        private readonly PurposeRepository $repository
    ){}

    private function transform(Purpose $purpose): PurposeDto
    {
        return PurposeDto::build(
            $purpose->getId(),
            $purpose->getName(),
        );
    }

    public function showAll(): PurposeDtoList
    {
        $purposes = $this->repository->findAll();

        return PurposeDtoList::build(
            array_map([$this, 'transform'], $purposes)
        );
    }

    public function take(string $name): ?Purpose
    {
        return $this->repository->findOneBy([
            'name' => $name
        ]);
    }

    public function create(PurposeDto $purposeDto): void
    {
        $purpose = PurposeFactory::build($purposeDto->getName());

        $this->repository->add($purpose, true);
    }
}