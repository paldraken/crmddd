<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

interface PasswordHasher
{
    public function hash(UserPassword $password): UserHashedPassword;

    public function verify(UserPassword $password, UserHashedPassword $hashedPassword): bool;
}