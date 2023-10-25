<?php

namespace App\Model\Purpose;

class PurposeDtoList
{
    /**
     * @var PurposeDto[]
     */
    private array $items;

    /**
     * @param PurposeDto[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return  PurposeDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param PurposeDto[] $items
     */
    public static function build(array $items): PurposeDtoList
    {
        return new PurposeDtoList($items);
    }
}