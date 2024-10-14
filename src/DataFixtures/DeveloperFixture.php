<?php

namespace App\DataFixtures;

use App\Model\Developer\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DeveloperFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->developers() as $developerData) {
            $developer = (new Developer())
                ->setName($developerData['name'])
                ->setSurname($developerData['surname'])
                ->setPatronymic($developerData['patronymic'])
                ->setStatus(Developer::STATUS_ACTIVE)
                ->setAge($developerData['age'])
                ->setEmail($developerData['email'])
                ->setPhone($developerData['phone'])
                ->setPosition($developerData['position'])
                ->addProject($developerData['project']);

            $manager->persist($developer);
        }

        $manager->flush();
    }

    private function developers(): array
    {
        $programmer = $this->getReference(PositionFixture::PROGRAMMER);
        $administrator = $this->getReference(PositionFixture::ADMINISTRATOR);
        $designer = $this->getReference(PositionFixture::DESIGNER);
        $devOps = $this->getReference(PositionFixture::DEV_OPS);

        $projectMusic = $this->getReference(ProjectFixture::PROJECT_MUSIC);
        $projectBank = $this->getReference(ProjectFixture::PROJECT_BANK);

        return [
            [
                'name' => 'Илья',
                'surname' => 'Викторович',
                'patronymic' => 'Круглов',
                'age' => 25,
                'email' => 'kruglov@mail.com',
                'phone' => '23-56-77',
                'position' => $programmer,
                'project' => $projectMusic
            ],
            [
                'name' => 'Виктор',
                'surname' => 'Александрович',
                'patronymic' => 'Курицын',
                'age' => 27,
                'email' => 'kuritsin@mail.com',
                'phone' => '98-37-00',
                'position' => $administrator,
                'project' => $projectBank
            ],
            [
                'name' => 'Алексей',
                'surname' => 'Григорьевич',
                'patronymic' => 'Панфилов',
                'age' => 29,
                'email' => 'panfilov@mail.com',
                'phone' => '55-19-83',
                'position' => $designer,
                'project' => $projectBank
            ],
            [
                'name' => 'Петр',
                'surname' => 'Анатольевич',
                'patronymic' => 'Шумилов',
                'age' => 32,
                'email' => 'shumilov@mail.com',
                'phone' => '78-46-91',
                'position' => $devOps,
                'project' => $projectMusic
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixture::class,
            PositionFixture::class,
        ];
    }
}
