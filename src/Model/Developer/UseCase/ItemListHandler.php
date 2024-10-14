<?php

namespace App\Model\Developer\UseCase;

use App\Model\Developer\Dto\Response\ItemDto;
use App\Model\Developer\Dto\Response\ItemListDto;
use App\Model\Developer\Entity\Developer;
use App\Model\Developer\Repository\DeveloperRepository;
use Doctrine\Common\Collections\Criteria;

class ItemListHandler
{
    public function __construct(
        private DeveloperRepository $developerRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(): ItemListDto
    {
        $developers = $this->developerRepository->findBy(
            ['status' => Developer::STATUS_ACTIVE],
            ['id' => Criteria::ASC]
        );

        $items = array_map(
            fn (Developer $developer) => $this->itemDto->map($developer),
            $developers
        );

        return new ItemListDto($items);
    }
}
