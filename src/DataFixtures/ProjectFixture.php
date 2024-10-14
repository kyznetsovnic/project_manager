<?php

namespace App\DataFixtures;

use App\Model\Project\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixture extends Fixture implements DependentFixtureInterface
{
    public const PROJECT_MUSIC = 'project_music';
    public const PROJECT_BANK = 'project_bank';

    public function load(ObjectManager $manager): void
    {
        $refData = [];

        foreach ($this->projects() as $projectName => $projectData) {
            $project = (new Project())
                ->setName($projectData['name'])
                ->setStatus(Project::STATUS_ACTIVE)
                ->setCustomer($projectData['customer']);

            $refData[$projectName] = $project;
            $manager->persist($project);
        }

        $manager->flush();

        foreach ($refData as $ref => $project) {
            $this->addReference($ref, $project);
        }
    }

    private function projects(): array
    {
        $firstCustomer = $this->getReference(CustomerFixture::FIRST_CUSTOMER);
        $secondCustomer = $this->getReference(CustomerFixture::SECOND_CUSTOMER);
        return [
            self::PROJECT_MUSIC => ['name' => 'Project music', 'customer' => $firstCustomer],
            self::PROJECT_BANK => ['name' => 'Project bank', 'customer' => $secondCustomer],
        ];
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixture::class,
        ];
    }
}
