<?php

namespace App\Entity;

use App\Entity\Trait\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Manufacturer
{
    use IdTrait;

    #[ORM\Column(unique: true)]
    private string $name;

    #[ORM\OneToMany('manufacturer', Matchbox::class)]
    private Collection $matchboxes;

    public function __construct()
    {
        $this->matchboxes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMatchboxes(): Collection
    {
        return $this->matchboxes;
    }

    public function addMatchbox(Matchbox $matchbox): self
    {
        if ($this->matchboxes->contains($matchbox)){
            $this->matchboxes[] = $matchbox;
            $matchbox->setManufacturer($this);
        }

        return $this;
    }
}