<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Persistence;

use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{

    public function loadUserByEmail(string $email): ?User
    {
        return $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.email.value = :email')
            ->setParameters(['email' => $email])
            ->getQuery()
            ->getOneOrNullResult();
    }

}