<?php

namespace App\Model\Project\Entity;

use App\Model\Customer\Entity\Customer;
use App\Model\Developer\Entity\Developer;
use App\Model\Project\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\Table(name: 'projects')]
class Project
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_CLOSED = 'closed';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $status;

    /**
     * @var Collection<int, Developer>
     */
    #[ORM\ManyToMany(targetEntity: Developer::class, mappedBy: 'projects')]
    private Collection $developers;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function __construct()
    {
        $this->developers = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomerToArray(): array
    {
        return [
            'id' => $this->customer->getId(),
            'name' => $this->customer->getName(),
            'surname' => $this->customer->getSurname(),
            'projects' => $this->customer->getProjectsToArray()
        ];
    }

    /**
     * @return Collection<int, Developer>
     */
    public function getDevelopers(): Collection
    {
        return $this->developers;
    }

    public function getDevelopersToArray(): array
    {
        $developers = [];
        foreach ($this->developers->toArray() as $developer) {
            $developers[] = [
                'id' => $developer->getId(),
                'name' => $developer->getFullName(),
                'age' => $developer->getAge(),
                'email' => $developer->getEmail(),
                'phone' => $developer->getPhone(),
                'position' => [
                    'id' => $developer->getPosition()->getId(),
                    'title' => $developer->getPosition()->getTitle()
                ]
            ];
        }

        return $developers;
    }

    public function addDeveloper(Developer $developer): self
    {
        if (!$this->developers->contains($developer)) {
            $this->developers->add($developer);
            $developer->addProject($this);
        }

        return $this;
    }

    public function removeDeveloper(Developer $developer): self
    {
        if ($this->developers->removeElement($developer)) {
            $developer->removeProject($this);
        }

        return $this;
    }
}
