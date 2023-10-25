<?php

namespace App\Model\Manufacturer;

use Symfony\Component\Validator\Constraints as Assert;

class ManufacturerDto
{
    public function __construct(
        private readonly ?int $id,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 3,
            max: 50,
            minMessage: 'не менее 3 символов',
            maxMessage: 'не более 50 символов',
        )]
        private readonly ?string $name,
    ){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function build(int $id, string $name): self
    {
        return new ManufacturerDto($id, $name);
    }
}