<?php

namespace App\Model\Position\Entity;

use App\Model\Developer\Entity\Developer;
use App\Model\Position\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionRepository::class)]
#[ORM\Table(name: 'positions')]
class Position
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $title;

    /**
     * @var Collection<int, Developer>
     */
    #[ORM\OneToMany(targetEntity: Developer::class, mappedBy: 'position')]
    private Collection $developers;

    public function __construct()
    {
        $this->developers = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<Developer>
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
}
