<?php

namespace App\Model\Matchbox;

use Symfony\Component\Validator\Constraints as Assert;

class MatchboxDto
{
    public function __construct(
        private readonly ?int $id,

        #[Assert\NotBlank]
        private readonly string $manufacturer,

        #[Assert\NotBlank]
        private readonly string $purpose,

        #[Assert\NotBlank]
        #[Assert\Length(
            max: 1,
            maxMessage: 'не более 9 см',
        )]
        private readonly int $length,

        #[Assert\NotBlank]
        private readonly int $count,

        #[Assert\Length(
            max: 255,
            maxMessage: 'не более 255 символов'
        )]
        private readonly ?string $description,
    ){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public static function build($id, $manufacturer, $purpose, $length, $count, $description): MatchboxDto
    {
        return new MatchboxDto($id, $manufacturer, $purpose, $length, $count, $description);
    }
}