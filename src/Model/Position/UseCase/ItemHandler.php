<?php

namespace App\Model\Position\UseCase;

use App\Model\Position\Dto\Response\ItemDto;
use App\Model\Position\Repository\PositionRepository;

class ItemHandler
{
    public function __construct(
        private PositionRepository $positionRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id): ItemDto
    {
        if (null === $position = $this->positionRepository->findOneBy(['id' => $id])) {
            throw new \DomainException(sprintf('Position with id %d does not exist.', $id));
        }

        return $this->itemDto->map($position);
    }
}
