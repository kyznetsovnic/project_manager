<?php

namespace App\Model\Customer\UseCase;

use App\Model\Customer\Dto\Response\ItemDto;
use App\Model\Customer\Repository\CustomerRepository;

class ItemHandler
{
    public function __construct(
        private CustomerRepository $customerRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(int $id): ItemDto
    {
        if (null === $customer = $this->customerRepository->findOneBy(['id' => $id])) {
            throw new \DomainException(sprintf('Customer with id %d does not exist.', $id));
        }

        return $this->itemDto->map($customer);
    }
}
