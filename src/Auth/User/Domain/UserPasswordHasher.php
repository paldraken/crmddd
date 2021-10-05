<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

interface UserPasswordHasher
{
    public function hash(string $password): string;

    public function verify(string $plaintPassword, string $hash): bool;
}