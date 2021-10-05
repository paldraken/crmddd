<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

interface UserRepository
{
    public function loadUserByEmail(string $email): ?User;
}