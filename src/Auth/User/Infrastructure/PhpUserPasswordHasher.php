<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\UserPasswordHasher;
use App\Auth\User\Domain\UserHashedPassword;
use App\Auth\User\Domain\UserPassword;
use App\Shared\Domain\Util;

class PhpUserPasswordHasher implements UserPasswordHasher
{
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify(string $plaintPassword, string $hash): bool
    {
        return password_verify($plaintPassword, $hash);
    }
}