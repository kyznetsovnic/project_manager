<?php

namespace App\Model\Project\UseCase;

use App\Model\Customer\Repository\CustomerRepository;
use App\Model\Developer\Repository\DeveloperRepository;
use App\Model\Project\Dto\Request\EditDto;
use App\Model\Project\Dto\Response\ItemDto;
use App\Model\Project\Repository\ProjectRepository;

class EditHandler
{
    public function __construct(
        private CustomerRepository $customerRepository,
        private DeveloperRepository $developerRepository,
        private ProjectRepository $projectRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id, EditDto $dto): ItemDto
    {
        if (null === $project = $this->projectRepository->findOneBy(['id' => $id])) {
            throw new \DomainException(sprintf('Project with id %s does not exist.', $id));
        }

        if (null !== $dto->developer) {
            if (null === $developer = $this->developerRepository->findOneBy(['id' => $dto->developer])) {
                throw new \DomainException(sprintf('Developer with id %s does not exist.', $dto->developer));
            }

            if ($dto->removeDeveloper) {
                $project->removeDeveloper($developer);
            } else {
                $project->addDeveloper($developer);
            }
        }

        $this->projectRepository->save($project);
        return $this->itemDto->map($project);
    }
}
