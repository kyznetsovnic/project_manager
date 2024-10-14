<?php

namespace App\Model\Developer\UseCase;

use App\Model\Developer\Dto\Request\EditDto;
use App\Model\Developer\Dto\Response\ItemDto;
use App\Model\Developer\Repository\DeveloperRepository;
use App\Model\Position\Repository\PositionRepository;
use App\Model\Project\Repository\ProjectRepository;

class EditHandler
{
    public function __construct(
        private DeveloperRepository $developerRepository,
        private ProjectRepository $projectRepository,
        private PositionRepository $positionRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id, EditDto $dto): ItemDto
    {
        if (null === $developer = $this->developerRepository->findOneBy(['id' => $id])) {
            throw new \DomainException(sprintf('Developer with id %d does not exist.', $id));
        }

        if ($dto->position !== null) {
            if (null === $position = $this->positionRepository->findOneBy(['id' => $dto->position])) {
                throw new \DomainException(sprintf('Position with id %d does not exist.', $dto->position));
            }

            $developer->setPosition($position);
        }

        if ($dto->project !== null) {
            if (null === $project = $this->projectRepository->findOneBy(['id' => $dto->project])) {
                throw new \DomainException(sprintf('Project with id %d does not exist.', $dto->project));
            }

            if($dto->removeProject) {
                $developer->removeProject($project);
            } else {
                $developer->addProject($project);
            }
        }

        $this->developerRepository->save($developer);
        return $this->itemDto->map($developer);
    }
}
