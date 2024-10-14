<?php

namespace App\Model\Project\UseCase;

use App\Model\Project\Dto\Response\ItemDto;
use App\Model\Project\Dto\Response\ItemListDto;
use App\Model\Project\Entity\Project;
use App\Model\Project\Repository\ProjectRepository;
use Doctrine\Common\Collections\Criteria;

class ItemListHandler
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(): ItemListDto
    {
        $projects = $this->projectRepository->findBy(
            ['status' => Project::STATUS_ACTIVE],
            ['id' => Criteria::ASC]
        );

        $items = array_map(
            fn (Project $project) => $this->itemDto->map($project),
            $projects
        );

        return new ItemListDto($items);
    }
}
