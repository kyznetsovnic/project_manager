<?php

namespace App\Model\Developer\Dto\Response;

class ItemListDto
{
    /**
     * @var list<ItemDto> $items
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
