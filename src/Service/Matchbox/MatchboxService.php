<?php

namespace App\Service\Matchbox;

use App\Entity\Matchbox;
use App\Factory\MatchboxFactory;
use App\Model\Matchbox\MatchboxDto;
use App\Model\Matchbox\MatchboxDtoList;
use App\Repository\MatchboxRepository;
use App\Service\Manufacturer\ManufacturerServiceInterface;
use App\Service\Purpose\PurposeServiceInterface;
use Doctrine\Common\Collections\Criteria;

class MatchboxService implements MatchboxServiceInterface
{
    public function __construct(
        private readonly MatchboxRepository $repository,
        private readonly ManufacturerServiceInterface $manufacturerService,
        private readonly PurposeServiceInterface $purposeService,
    )
    {}

    private function transform(Matchbox $matchbox): MatchboxDto
    {
        return MatchboxDto::build(
            $matchbox->getId(),
            $matchbox->getManufacturer()->getName(),
            $matchbox->getPurpose()->getName(),
            $matchbox->getLength(),
            $matchbox->getCountMatch(),
            $matchbox->getDescription(),
        );
    }

    public function showOne(Matchbox $matchbox): MatchboxDto
    {
        return $this->transform($matchbox);
    }

    public function showAll(): MatchboxDtoList
    {
        $matchboxes = $this->repository->findBy(
            [], ['manufacturer' => Criteria::DESC]
        );

        return MatchboxDtoList::build(
            array_map([ $this, 'transform' ], $matchboxes)
        );
    }

    public function create(MatchboxDto $matchboxDto): void
    {
        $manufacturer = $this->manufacturerService->take(
            $matchboxDto->getManufacturer()
        );

        $purpose = $this->purposeService->take(
            $matchboxDto->getPurpose()
        );

        $matchbox = MatchboxFactory::build($matchboxDto, $manufacturer, $purpose);

        $this->repository->add($matchbox, true);
    }
}