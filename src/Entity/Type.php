<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api:pokemon:read','api:type:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\ManyToMany(targetEntity: Pokemon::class, mappedBy: 'types')]
    #[Groups(['api:type:read','api:type:read'])]
    private Collection $pokemon;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Pokemon>
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

    public function addPokemon(Pokemon $pokemon): static
    {
        if (!$this->pokemon->contains($pokemon)) {
            $this->pokemon->add($pokemon);
            $pokemon->addType($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): static
    {
        if ($this->pokemon->removeElement($pokemon)) {
            $pokemon->removeType($this);
        }

        return $this;
    }
}
