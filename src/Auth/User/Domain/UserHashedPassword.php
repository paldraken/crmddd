<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

class UserHashedPassword
{
    public function __construct(
        private string $passwordHash,
        private string $salt
    )
    {
    }

    public function passwordHash(): string
    {
        return $this->passwordHash;
    }

    public function salt(): string
    {
        return $this->salt;
    }
}