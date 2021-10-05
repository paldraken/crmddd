<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use App\Auth\User\Domain\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class MyUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return $class instanceof MyAppUser;
    }

    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        $user = $this->userRepository->loadUserByEmail($identifier);
        if ($user === null) {
            throw new UserNotFoundException();
        }
        return new MyAppUser($user);
    }

    public function loadUserByUsername(string $username)
    {
        // TODO: Implement loadUserByUsername() method.
    }


}