<?php

declare(strict_types=1);

namespace App\Core\Deal\Domain;

use App\Auth\Company\Domain\CompanyId;
use App\Core\Customer\Domain\Customer;
use App\Core\Stage\Domain\Stage;
use App\Shared\Domain\AggregateRoot;
use DateTimeImmutable;

class Deal extends AggregateRoot
{
    public function __construct(
        private DealId $id,
        private CompanyId $companyId,
        private Stage $stage,
        private Customer $customer,
        private DealName $name,
        private DateTimeImmutable $updatedAt,
        private DateTimeImmutable $createdAt,
    )
    {
    }

    public function changeStage(Stage $from, Stage $to): void
    {

    }

    public function id(): DealId
    {
        return $this->id;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }

    public function stage(): Stage
    {
        return $this->stage;
    }

    public function customer(): Customer
    {
        return $this->customer;
    }

    public function name(): DealName
    {
        return $this->name;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

}