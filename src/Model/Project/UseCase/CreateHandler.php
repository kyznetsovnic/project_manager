<?php

namespace App\Model\Project\UseCase;

use App\Model\Customer\Repository\CustomerRepository;
use App\Model\Developer\Repository\DeveloperRepository;
use App\Model\Project\Dto\Request\CreateDto;
use App\Model\Project\Dto\Response\ItemDto;
use App\Model\Project\Entity\Project;
use App\Model\Project\Repository\ProjectRepository;

class CreateHandler
{
    public function __construct(
        private CustomerRepository $customerRepository,
        private DeveloperRepository $developerRepository,
        private ProjectRepository $projectRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(CreateDto $dto): ItemDto
    {
        if (null === $customer = $this->customerRepository->findOneBy(['id' => $dto->customer])) {
            throw new \DomainException(sprintf('Customer with id %s does not exist.', $dto->customer));
        }

        $project = (new Project())
            ->setStatus(Project::STATUS_ACTIVE)
            ->setName($dto->name)
            ->setCustomer($customer);

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
