<?php

namespace App\Model\Customer\UseCase;

use App\Model\Customer\Dto\Response\ItemDto;
use App\Model\Customer\Dto\Response\ItemListDto;
use App\Model\Customer\Entity\Customer;
use App\Model\Customer\Repository\CustomerRepository;
use Doctrine\Common\Collections\Criteria;

class ItemListHandler
{
    public function __construct(
        private CustomerRepository $customerRepository,
        private ItemDto $itemDto
    ) {
    }

    public function handle(): ItemListDto
    {
        $customers = $this->customerRepository->findBy([], ['id' => Criteria::ASC]);

        $items = array_map(
            fn (Customer $customer) => $this->itemDto->map($customer),
            $customers
        );

        return new ItemListDto($items);
    }
}
