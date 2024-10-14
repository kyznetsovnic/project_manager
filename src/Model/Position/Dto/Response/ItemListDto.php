<?php

namespace App\Model\Position\Dto\Response;

class ItemListDto
{
    /**
     * @param list<ItemDto> $items
     */
    public function __construct(private array $items)
    {
    }

    /**
     * @return list<ItemDto>
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
