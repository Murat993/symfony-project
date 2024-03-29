<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Reset\Request;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
}