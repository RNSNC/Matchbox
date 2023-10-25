<?php

namespace App\Model\Manufacturer;

class ManufacturerDtoList
{
    /**
     * @var ManufacturerDto[]
     */
    private array $items;

    /**
     * @param ManufacturerDto[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ManufacturerDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ManufacturerDto[] $items
     */
    public static function build(array $items): ManufacturerDtoList
    {
        return new ManufacturerDtoList($items);
    }
}