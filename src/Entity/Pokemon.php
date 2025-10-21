<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?int $pokedexNumber = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemon')]
    #[Groups('api:pokemon:read')]
    private Collection $types;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?string $imageUrl = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?string $soundUrl = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?int $generation = null;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokedexNumber(): ?int
    {
        return $this->pokedexNumber;
    }

    public function setPokedexNumber(int $pokedexNumber): static
    {
        $this->pokedexNumber = $pokedexNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getSoundUrl(): ?string
    {
        return $this->soundUrl;
    }

    public function setSoundUrl(string $soundUrl): static
    {
        $this->soundUrl = $soundUrl;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(?int $generation): static
    {
        $this->generation = $generation;

        return $this;
    }
}
