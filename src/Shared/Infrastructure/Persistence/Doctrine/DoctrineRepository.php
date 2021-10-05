<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function persist(AggregateRoot $aggregateRoot): void
    {
        $this->entityManager()->persist($aggregateRoot);
        $this->entityManager()->flush();
    }

    /**
     * @psalm-param class-string $entityClass
     * @return EntityRepository
     */
    protected function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager()->getRepository($entityClass);
    }
}