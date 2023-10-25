<?php

namespace App\Controller\Api;

use App\Entity\Matchbox;
use App\Model\Matchbox\MatchboxDto;
use App\Service\Matchbox\MatchboxServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class MatchboxApiController extends AbstractController
{
    public function __construct(
        private readonly MatchboxServiceInterface $service,
    )
    {}

    #[Route('/api/matchbox', 'get_matchboxes', methods: ['GET'])]
    public function showMatchboxes(): Response
    {
        return $this->json(
            $this->service->showAll()
        );
    }

    #[Route('/api/matchbox/{id}', 'get_matchbox', methods: ['GET'])]
    public function showMatchbox(Matchbox $matchbox): Response
    {
        return $this->json(
            $this->service->showOne($matchbox)
        );
    }

    #[Route('/api/matchbox', 'post_matchbox', methods: ['POST'])]
    public function createMatchbox(
        #[MapRequestPayload] MatchboxDto $matchboxDto,
    ): Response
    {
        $this->service->create($matchboxDto);
        return new Response('success');
    }
}