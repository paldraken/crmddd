<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Auth\Company\Domain\Company;
use App\Auth\User\Domain\Errors\NotUniqueEmailError;
use App\Auth\User\Domain\Events\UserWasCreatedDomainEvent;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;


class User extends AggregateRoot
{
    public function __construct(
        private UserId $id,
        private Company $company,
        private UserEmail $email,
        private UserFullName $fullName,
        private string $hashedPassword,
        private DateTimeImmutable $createdAt
    )
    {
    }

    public static function create(
        UserId                  $id,
        Company                 $company,
        UserEmail               $email,
        UserFullName            $fullName,
        UserPassword            $password,
        UserPasswordHasher      $passwordHasher,
        UniqueUserSpecification $uniqueUserSpecification
    ): self
    {
        if(!$uniqueUserSpecification->isSatisfiedBy($email)) {
            throw new NotUniqueEmailError($email->value());
        }

        $passwordHash = $passwordHasher->hash($password->value());

        $createdAt = new DateTimeImmutable();

        $user = new self($id, $company, $email, $fullName, $passwordHash, $createdAt);

        $user->record(new UserWasCreatedDomainEvent($id->value(), $fullName->value(), $email->value()));

        return $user;
    }

    public function changePassword(UserPassword $password): void
    {

    }

    public function company(): Company
    {
        return $this->company;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function fullName(): UserFullName
    {
        return $this->fullName;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function hashedPassword(): string
    {
        return $this->hashedPassword;
    }

}