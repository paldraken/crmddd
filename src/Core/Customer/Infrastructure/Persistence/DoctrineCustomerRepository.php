<?php

declare(strict_types=1);

namespace App\Core\Customer\Infrastructure\Persistence;

use App\Core\Customer\Domain\Customer;
use App\Core\Customer\Domain\CustomerId;
use App\Core\Customer\Domain\CustomerRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCustomerRepository extends DoctrineRepository implements CustomerRepository
{
    public function save(Customer $customer): void
    {
        $this->persist($customer);
    }

    public function findById(CustomerId $id): ?Customer
    {
        return $this->repository(Customer::class)->find($id);
    }
}