<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use App\Auth\User\Domain\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class MyAppUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private User $user
    )
    {
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): string
    {
        return $this->user->hashedPassword();
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): string
    {
        return $this->user->email()->value();
    }


}