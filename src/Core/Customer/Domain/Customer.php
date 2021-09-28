<?php

declare(strict_types=1);

namespace App\Core\Customer\Domain;

use App\Core\Customer\Domain\Events\CustomerCreatedDomainEvent;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;

final class Customer extends AggregateRoot
{
    public function __construct(
        private CustomerId $id,
        private CustomerName $name,
        private CustomerPhone $phone,
        private CustomerEmail $email,
        private DateTimeImmutable $createdAt
    )
    {
    }

    public static function create(
        CustomerId $id,
        CustomerName $name,
        CustomerPhone $phone,
        CustomerEmail $email,
    ): self
    {
        $createdAt = new DateTimeImmutable();

        $customer = new self($id, $name, $phone, $email, $createdAt);

        $customer->record(
            new CustomerCreatedDomainEvent(
                $customer->id->value(),
                $customer->name->value(),
                $customer->email->value(),
                $customer->phone->value()
            )
        );

        return $customer;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): CustomerName
    {
        return $this->name;
    }

    public function phone(): CustomerPhone
    {
        return $this->phone;
    }

    public function email(): CustomerEmail
    {
        return $this->email;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

}