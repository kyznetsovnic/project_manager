<?php

namespace App\Model\Project\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class EditDto
{
    #[Assert\Type(
        type: 'integer',
        message: 'Developer value {{ value }} is not a valid {{ type }}.'
    )]
    public ?int $developer = null;

    public bool $removeDeveloper = false;
}