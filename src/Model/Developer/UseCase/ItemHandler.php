<?php

namespace App\Model\Developer\UseCase;

use App\Model\Developer\Dto\Response\ItemDto;
use App\Model\Developer\Entity\Developer;
use App\Model\Developer\Repository\DeveloperRepository;

class ItemHandler
{
    public function __construct(
        private DeveloperRepository $developerRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id): ItemDto
    {
        if (null === $developer = $this->developerRepository->findOneBy(['id' => $id, 'status' => Developer::STATUS_ACTIVE])) {
            throw new \DomainException(sprintf('Developer with id %d does not exist or dismissed.', $id));
        }

        return $this->itemDto->map($developer);
    }
}
