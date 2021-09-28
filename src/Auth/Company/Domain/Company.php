<?php

declare(strict_types=1);

namespace App\Auth\Company\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;

class Company extends AggregateRoot
{
    public function __construct(
        private CompanyId $id,
        private CompanyName $name,
        private DateTimeImmutable $registeredAt
    )
    {
    }

    public static function create(
        CompanyId $id,
        CompanyName $name,
    ): Company
    {
        $registeredAt = new DateTimeImmutable();

        return new Company($id, $name, $registeredAt);
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): CompanyName
    {
        return $this->name;
    }

    public function registeredAt(): DateTimeImmutable
    {
        return $this->registeredAt;
    }
}