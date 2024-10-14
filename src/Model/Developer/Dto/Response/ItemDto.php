<?php

namespace App\Model\Developer\Dto\Response;

use App\Model\Developer\Entity\Developer;
use App\Model\Project\Entity\Project;

class ItemDto
{
    private int $id;

    private string $fullName;

    private array $position;

    private ?string $email;

    private ?string $phone;

    private string $status;

    private int $age;

    private array $projects;

    public function map(Developer $developer): ItemDto
    {
        $this->id = $developer->getId();
        $this->fullName = $developer->getFullName();
        $this->position = $developer->getPositionToArray();
        $this->email = $developer->getEmail();
        $this->phone = $developer->getPhone();
        $this->status = $developer->getStatus();
        $this->age = $developer->getAge();
        $this->projects = $developer->getProjectsToArray();

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getPosition(): array
    {
        return $this->position;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return list<Project>
     */
    public function getProjects(): array
    {
        return $this->projects;
    }
}
