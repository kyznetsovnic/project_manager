<?php

namespace App\Model\Project\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreateDto extends EditDto
{
    #[Assert\Type(
        type: 'integer',
        message: 'Customer value {{ value }} is not a valid {{ type }}.'
    )]
    #[Assert\NotBlank(message: 'Customer field should not be blank')]
    public int $customer;

    #[Assert\NotBlank(message: 'Project name field should not be blank')]
    public string $name;
}
