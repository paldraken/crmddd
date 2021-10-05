<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use App\Auth\User\Domain\UserPasswordHasher;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class MySymfonyPasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private UserPasswordHasher $myPasswordHasher
    )
    {
    }

    public function hash(string $plainPassword): string
    {
        return $this->myPasswordHasher->hash($plainPassword);
    }

    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        return $this->myPasswordHasher->verify($plainPassword, $hashedPassword);
    }

    public function needsRehash(string $hashedPassword): bool
    {
        return false;
    }
}