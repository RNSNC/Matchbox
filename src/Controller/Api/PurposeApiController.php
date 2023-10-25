<?php

namespace App\Controller\Api;

use App\Model\Purpose\PurposeDto;
use App\Service\Purpose\PurposeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class PurposeApiController extends AbstractController
{
    public function __construct(
        private readonly PurposeServiceInterface $service
    )
    {}

    #[Route('/api/purpose', 'get_purpose', methods: ['GET'])]
    public function show(): Response
    {
        return $this->json(
            $this->service->showAll()
        );
    }

    #[Route('/api/purpose', 'post_purpose', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] PurposeDto $purposeDto
    ): Response
    {
        $this->service->create($purposeDto);
        return new Response('success');
    }
}