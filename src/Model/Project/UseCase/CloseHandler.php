<?php

namespace App\Model\Project\UseCase;

use App\Model\Project\Dto\Response\ItemDto;
use App\Model\Project\Entity\Project;
use App\Model\Project\Repository\ProjectRepository;

class CloseHandler
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id): ItemDto
    {
        if (null === $project = $this->projectRepository->findOneBy(['id' => $id])) {
            throw new \DomainException(sprintf('Project with id %d does not exist.', $id));
        }

        $project->setStatus(Project::STATUS_CLOSED);
        $this->projectRepository->save($project);

        return $this->itemDto->map($project);
    }
}
