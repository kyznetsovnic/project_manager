<?php

namespace App\Model\Developer\Entity;

use App\Model\Developer\Repository\DeveloperRepository;
use App\Model\Position\Entity\Position;
use App\Model\Project\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
#[ORM\Table(name: 'developers')]
class Developer
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISMISSED = 'dismissed';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $surname;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $patronymic;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'developers')]
    #[ORM\JoinColumn(nullable: false)]
    private Position $position;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'developers')]
    private Collection $projects;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $status;

    #[ORM\Column(type: Types::SMALLINT, nullable: false)]
    private int $age;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
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

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    public function setPatronymic(string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    public function getFullName(): string
    {
        return sprintf(
            '%s %s %s',
            $this->name,
            $this->surname,
            $this->patronymic
        );
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function setPosition(Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPositionToArray(): array
    {
        return [
            'id' => $this->position->getId(),
            'title' => $this->position->getTitle()
        ];
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

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function getProjectsToArray(): array
    {
        $projects = [];
        foreach ($this->projects->toArray() as $project) {
            $projects[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'status' => $project->getStatus(),
                'developers' => $project->getDevelopersToArray()
            ];
        }

        return $projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        $this->projects->removeElement($project);

        return $this;
    }
}
