<?php

namespace App\Model\Developer\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class EditDto
{
    #[Assert\Type(
        type: 'integer',
        message: 'Position value {{ value }} is not a valid {{ type }}.'
    )]
    public ?int $position = null;

    #[Assert\Type(
        type: 'integer',
        message: 'Position value {{ value }} is not a valid {{ type }}.'
    )]
    public ?int $project = null;

    public bool $removeProject = false;
}
