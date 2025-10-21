<?php

namespace App\Factory;

use App\Entity\Pokemon;
use App\Repository\TypeRepository;

class PokemonFactory
{
    public function __construct(private TypeRepository $typeRepository)
    {
    }

    public function fromArray(array $pokemonAsArray): Pokemon
    {
        $pokemon = (new Pokemon())
            ->setPokedexNumber($pokemonAsArray['number'])
            ->setName($pokemonAsArray['name'])
            ->setDescription($pokemonAsArray['description'])
            ->setGeneration($pokemonAsArray['generation'])
            ->setImageUrl($pokemonAsArray['imageUrl'])
            ->setSoundUrl($pokemonAsArray['soundUrl']);

        foreach ($pokemonAsArray['types'] as $type) {
            $pokemon->addType($this->typeRepository->findOneBy(['name' => $type]));
        }

        return $pokemon;
    }
}