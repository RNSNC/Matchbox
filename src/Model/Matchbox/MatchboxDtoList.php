<?php

namespace App\Model\Matchbox;

class MatchboxDtoList
{
    /**
     * @var MatchboxDto[]
     */
    private array $items;

    /**
     * @param MatchboxDto[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return  MatchboxDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param MatchboxDto[] $items
     */
    public static function build(array $items): MatchboxDtoList
    {
        return new MatchboxDtoList($items);
    }
}