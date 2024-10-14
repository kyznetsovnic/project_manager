<?php

namespace App\DataFixtures;

use App\Model\Position\Entity\Position;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PositionFixture extends Fixture
{
    public const PROGRAMMER = 'programmer';
    public const ADMINISTRATOR = 'administrator';
    public const DEV_OPS = 'devOps';
    public const DESIGNER = 'designer';

    public function load(ObjectManager $manager): void
    {
        $refData = [];
        foreach ($this->positions() as $positionName => $positionTitle) {
            $position = (new Position())
                ->setTitle($positionTitle);

            $manager->persist($position);
            $refData[$positionName] = $position;
        }

        $manager->flush();

        foreach ($refData as $ref => $position) {
            $this->addReference($ref, $position);
        }
    }

    private function positions(): array
    {
        return [
            self::PROGRAMMER => "Программист",
            self::ADMINISTRATOR => "Администратор",
            self::DEV_OPS => "DevOps",
            self::DESIGNER => "Дизайнер"
        ];
    }
}
