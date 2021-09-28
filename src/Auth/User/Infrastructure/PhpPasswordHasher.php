<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\PasswordHasher;
use App\Auth\User\Domain\UserHashedPassword;
use App\Auth\User\Domain\UserPassword;
use App\Shared\Domain\Util;

class PhpPasswordHasher implements PasswordHasher
{
    public function hash(UserPassword $password): UserHashedPassword
    {
        $salt = Util::generateRandomString(16);

        $hash = password_hash($this->passwordWithSalt($password->value(), $salt), PASSWORD_BCRYPT);

        return new UserHashedPassword($hash, $salt);
    }

    public function verify(UserPassword $password, UserHashedPassword $hashedPassword): bool
    {
        return password_verify(
            $this->passwordWithSalt($password->value(), $hashedPassword->salt()),
            $hashedPassword->passwordHash()
        );
    }

    private function passwordWithSalt(string $password, string $salt): string
    {
        return $password . ':' . $salt;
    }
}