<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Service\PokemonService;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Attribute as Nelmio;

#[Route('/api/pokemon')]
final class ApiPokemonController extends AbstractController
{
    public function __construct(private readonly PokemonService $pokemonService)
    {
    }

    #[Route('/all', name: 'getAllPokemons')]
    public function getAllPokemons(): JsonResponse
    {
        return $this->json([
            'pokemons' => $this->pokemonService->getAllPokemons(),
        ],
        context: ['groups' => 'api:pokemon:read']);
    }

    #[Route('/{name}', name: 'getPokemonByName')]
    public function getPokemonByName(Pokemon $pokemon): JsonResponse
    {
        return $this->json([
            'pokemon' => $pokemon,
            ],
            context: ['groups' => 'api:pokemon:read']
        );
    }

    #[Route('/generation/{generation}', name: 'getPokemonsByGeneration')]
    public function getPokemonsByGeneration(int $generation): JsonResponse
    {
        return $this->json([
            'pokemon' => $this->pokemonService->getPokemonByGeneration($generation),
        ],
            context: ['groups' => 'api:pokemon:read']
        );
    }
}
