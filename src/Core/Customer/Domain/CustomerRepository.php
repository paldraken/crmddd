<?php

declare(strict_types=1);

namespace App\Core\Customer\Domain;

interface CustomerRepository
{
    public function save(Customer $customer): void;

    public function findById(CustomerId $id): ?Customer;
}