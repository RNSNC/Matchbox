<?php

namespace App\Controller\Api;

use App\Model\Manufacturer\ManufacturerDto;
use App\Service\Manufacturer\ManufacturerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class ManufacturerApiController extends AbstractController
{
    public function __construct(
        private readonly ManufacturerServiceInterface $service
    )
    {}

    #[Route('/api/manufacturer', 'get_manufacturer', methods: ['GET'])]
    public function show(): Response
    {
        return $this->json(
            $this->service->showAll()
        );
    }

    #[Route('/api/manufacturer', 'post_manufacturer', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] ManufacturerDto $manufacturerDto
    ): Response
    {
        $this->service->create($manufacturerDto);
        return new Response('success');
    }
}