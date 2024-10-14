<?php

namespace App\Model\Position\Dto\Response;

use App\Model\Position\Entity\Position;

class ItemDto
{
    private int $id;

    private string $title;

    private array $developers;

    public function map(Position $position): ItemDto
    {
        $this->id = $position->getId();
        $this->title = $position->getTitle();
        $this->developers = $position->getDevelopersToArray();

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDevelopers(): array
    {
        return $this->developers;
    }
}
