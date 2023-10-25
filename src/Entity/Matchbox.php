<?php

namespace App\Entity;

use App\Entity\Trait\IdTrait;
use App\Repository\MatchboxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchboxRepository::class)]
class Matchbox
{
    use IdTrait;

    #[ORM\ManyToOne(inversedBy: 'matchboxes')]
    private Manufacturer $manufacturer;

    #[ORM\ManyToOne]
    private Purpose $purpose;

    #[ORM\Column]
    private int $countMatch;

    #[ORM\Column]
    private int $length;

    #[ORM\Column(nullable: true)]
    private ?string $description;

    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getCountMatch(): int
    {
        return $this->countMatch;
    }

    public function setCountMatch(int $countMatch): self
    {
        $this->countMatch = $countMatch;

        return $this;
    }

    public function getPurpose(): Purpose
    {
        return $this->purpose;
    }

    public function setPurpose(Purpose $purpose): self
    {
        $this->purpose = $purpose;

        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}