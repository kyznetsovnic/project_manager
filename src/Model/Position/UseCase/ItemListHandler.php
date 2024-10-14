<?php

namespace App\Model\Position\UseCase;

use App\Model\Position\Dto\Response\ItemDto;
use App\Model\Position\Dto\Response\ItemListDto;
use App\Model\Position\Entity\Position;
use App\Model\Position\Repository\PositionRepository;
use Doctrine\Common\Collections\Criteria;

class ItemListHandler
{
    public function __construct(
        private PositionRepository $positionRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(): ItemListDto
    {
        $positions = $this->positionRepository->findBy([], ['id' => Criteria::ASC]);

        $items = array_map(
            fn (Position $position) => $this->itemDto->map($position),
            $positions
        );

        return new ItemListDto($items);
    }
}
