<?php

namespace App\Model\Developer\UseCase;

use App\Model\Developer\Dto\Response\ItemDto;
use App\Model\Developer\Entity\Developer;
use App\Model\Developer\Repository\DeveloperRepository;

class DismissHandler
{
    public function __construct(
        private DeveloperRepository $developerRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id): ItemDto
    {
        if (null === $developer = $this->developerRepository->findOneBy(['id' => $id])) {
            throw new \DomainException(sprintf('Developer with id %s does not exist.', $id));
        }

        $developer->setStatus(Developer::STATUS_DISMISSED);
        $this->developerRepository->save($developer);

        return $this->itemDto->map($developer);
    }
}
