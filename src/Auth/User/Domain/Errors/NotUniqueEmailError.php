<?php

declare(strict_types=1);

namespace App\Auth\User\Domain\Errors;

use App\Shared\Domain\DomainError;

final class NotUniqueEmailError extends DomainError
{
    public function __construct(string $email)
    {
        $msg = "User with email: {$email} has been already registered.";

        parent::__construct($msg, 0, null);
    }
}