<?php

namespace App\DataFixtures;

use App\Model\Customer\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixture extends Fixture
{
    public const FIRST_CUSTOMER = 'first_customer';
    public const SECOND_CUSTOMER = 'second_customer';

    public function load(ObjectManager $manager): void
    {
        $refData = [];

        foreach ($this->customers() as $customerName => $customerData) {
            $customer = (new Customer())
                ->setName($customerData['name'])
                ->setSurname($customerData['surname']);

            $refData[$customerName] = $customer;
            $manager->persist($customer);
        }

        $manager->flush();

        foreach ($refData as $ref => $customer) {
            $this->addReference($ref, $customer);
        }
    }

    private function customers(): array
    {
        return [
            self::FIRST_CUSTOMER => ['name' => 'Сергей', 'surname' => 'Васильев'],
            self::SECOND_CUSTOMER => ['name' => 'Андрей', 'surname' => 'Петров'],
        ];
    }
}
