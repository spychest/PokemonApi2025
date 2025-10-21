<?php

namespace App\Service;

use App\Factory\PokemonFactory;
use App\Repository\PokemonRepository;

class PokemonService
{
    public function __construct(private PokemonRepository $pokemonRepository, private PokemonFactory $pokemonFactory)
    {
    }

    public function getAllPokemons(): array
    {
        return $this->pokemonRepository->findAll();
    }

    public function getPokemonByGeneration(int $generation): array
    {
        return $this->pokemonRepository->findBy(['generation' => $generation]);
    }

    public function createPokemons(array $pokemons): void
    {
        foreach($pokemons as $pokemon) {
            $this->createPokemon($pokemon);
        }
    }

    private function createPokemon(array $pokemonAsArray): void
    {
        $pokemon = $this->pokemonFactory->fromArray($pokemonAsArray);
        $this->pokemonRepository->register($pokemon);
    }
}