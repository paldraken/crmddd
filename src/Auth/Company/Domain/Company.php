<?php

declare(strict_types=1);

namespace App\Auth\Company\Domain;

use App\Auth\Company\Domain\Events\CompanyWasRegisteredDomainEvent;
use App\Auth\User\Domain\User;
use App\Shared\Domain\AggregateRoot;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Company extends AggregateRoot
{
    /**
     * @psalm-var Collection<int, User>
     */
    private Collection $users;

    public function __construct(
        private CompanyId $id,
        private CompanyName $name,
        private DateTimeImmutable $registeredAt
    )
    {
        $this->users = new ArrayCollection();
    }

    public static function create(
        CompanyId $id,
        CompanyName $name
    ): Company
    {
        $registeredAt = new DateTimeImmutable();

        $company = new Company($id, $name, $registeredAt);

        $company->record(new CompanyWasRegisteredDomainEvent($id->value(), $name->value()));

        return $company;
    }

    public function addUser(User $user): void
    {
        $this->users->add($user);
    }

    public function id(): CompanyId
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

    /**
     * @return Collection
     * @psalm-return Collection<int, User>
     */
    public function users(): Collection
    {
        return $this->users;
    }
}