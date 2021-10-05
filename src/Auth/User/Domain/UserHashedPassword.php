<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use Webmozart\Assert\Assert;

class UserHashedPassword
{
    public function __construct(
        private string $passwordHash,
        private string $salt
    )
    {
        Assert::notEmpty($this->passwordHash);
        Assert::notEmpty($this->salt);
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