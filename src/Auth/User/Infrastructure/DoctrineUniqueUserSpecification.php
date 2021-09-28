<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\UniqueUserSpecification;
use App\Auth\User\Domain\UserEmail;
use Doctrine\ORM\EntityManager;

class DoctrineUniqueUserSpecification implements UniqueUserSpecification
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    public function isSatisfiedBy(UserEmail $email): bool
    {
        return $this->entityManager->createQueryBuilder()
            ->select('id')
            ->from('User', 'u')
            ->where('u.email = ?email')
            ->setParameter('email', $email->value())
            ->getQuery()
            ->getOneOrNullResult() === null;
    }
}