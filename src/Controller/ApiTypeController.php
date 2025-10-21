<?php

namespace App\Controller;

use App\Service\TypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/type')]
final class ApiTypeController extends AbstractController
{
    public function __construct(private readonly TypeService $typeService)
    {
    }

    #[Route('/all', name: 'getAllType')]
    public function index(): JsonResponse
    {
        return $this->json([
            'types' => $this->typeService->getTypes(),
        ],
        context: ['groups' => 'api:type:read']);
    }
}
