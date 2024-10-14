<?php

namespace App\Model\Customer\Dto\Response;

use App\Model\Customer\Entity\Customer;

class ItemDto
{
    private int $id;

    private string $name;

    private string $surname;

    private array $progects;

    public function map(Customer $customer): ItemDto
    {
        $this->id = $customer->getId();
        $this->name = $customer->getName();
        $this->surname = $customer->getSurname();
        $this->progects = $customer->getProjectsToArray();

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

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getProgects(): array
    {
        return $this->progects;
    }
}
