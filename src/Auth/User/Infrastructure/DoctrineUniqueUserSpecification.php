<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\UniqueUserSpecification;
use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserEmail;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUniqueUserSpecification implements UniqueUserSpecification
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function isSatisfiedBy(UserEmail $email): bool
    {
        return $this->entityManager->createQueryBuilder()
                ->select('u')
                ->from(User::class, 'u')
                ->where('u.email.value = :email')
                ->setParameters(['email' => $email->value()])
                ->getQuery()
                ->getOneOrNullResult() === null;
    }
}