<?php

namespace App\Model\Project\Dto\Response;

use App\Model\Project\Entity\Project;

class ItemDto
{
    private int $id;

    private string $name;

    private string $status;

    private array $customer;

    public function map(Project $project): ItemDto
    {
        $this->id = $project->getId();
        $this->name = $project->getName();
        $this->status = $project->getStatus();
        $this->customer = $project->getCustomerToArray();

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCustomer(): array
    {
        return $this->customer;
    }
}
