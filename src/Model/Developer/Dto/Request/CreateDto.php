<?php

namespace App\Model\Developer\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreateDto extends EditDto
{
    #[Assert\NotBlank(message: 'Name field should not be blank')]
    public string $name;

    #[Assert\NotBlank(message: 'Surname field should not be blank')]
    public string $surname;

    #[Assert\NotBlank(message: 'Patronymic field should not be blank')]
    public string $patronymic;

    #[Assert\Email(message: 'Email value {{ value }} is not a valid email address.')]
    #[Assert\NotBlank(message: 'Email field should not be blank')]
    public string $email;

    #[Assert\NotBlank(message: 'Phone field should not be blank')]
    public string $phone;

    #[Assert\Type(
        type: 'integer',
        message: 'Age value {{ value }} is not a valid {{ type }}.'
    )]
    #[Assert\NotBlank(message: 'Age field should not be blank')]
    public int $age;
}
