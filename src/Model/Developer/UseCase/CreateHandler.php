<?php

namespace App\Model\Developer\UseCase;

use App\Model\Developer\Dto\Request\CreateDto;
use App\Model\Developer\Dto\Response\ItemDto;
use App\Model\Developer\Entity\Developer;
use App\Model\Developer\Repository\DeveloperRepository;
use App\Model\Position\Repository\PositionRepository;
use App\Model\Project\Repository\ProjectRepository;

class CreateHandler
{
    public function __construct(
        private DeveloperRepository $developerRepository,
        private PositionRepository $positionRepository,
        private ProjectRepository $projectRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(CreateDto $dto): ItemDto
    {
        if ($this->developerRepository->hasByEmail($dto->email)) {
            throw new \DomainException(sprintf('Developer with email %s already exists.', $dto->email));
        }

        $developer = (new Developer())
            ->setEmail($dto->email)
            ->setName($dto->name)
            ->setSurname($dto->surname)
            ->setPatronymic($dto->patronymic)
            ->setAge($dto->age)
            ->setPhone($dto->phone)
            ->setStatus(Developer::STATUS_ACTIVE)
        ;

        if ($dto->position !== null) {
            if (null === $position = $this->positionRepository->findOneBy(['id' => $dto->position])) {
                throw new \DomainException(sprintf('Position with id %s does not exist.', $dto->position));
            }

            $developer->setPosition($position);
        }

        if ($dto->project !== null) {
            if (null === $project = $this->projectRepository->findOneBy(['id' => $dto->project])) {
                throw new \DomainException(sprintf('Project with id %s does not exist.', $dto->project));
            }
            $developer->addProject($project);
        }

        $this->developerRepository->save($developer);
        return $this->itemDto->map($developer);
    }
}
