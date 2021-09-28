<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Auth\User\Domain\Errors\NotUniqueEmailError;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;
use Webmozart\Assert\Assert;

class User extends AggregateRoot
{
    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserFullName $fullName,
        private UserHashedPassword $hashedPassword,
        private DateTimeImmutable $createdAt
    )
    {
    }

    public static function create(
        UserId $id,
        UserEmail $email,
        UserFullName $fullName,
        UserPassword $password,
        PasswordHasher $passwordHasher,
        UniqueUserSpecification $uniqueUserSpecification
    ): self
    {
        if(!$uniqueUserSpecification->isSatisfiedBy($email)) {
            throw new NotUniqueEmailError($email->value());
        }

        $passwordHash = $passwordHasher->hash($password);

        $createdAt = new DateTimeImmutable();

        return new self($id, $email, $fullName, $passwordHash, $createdAt);
    }

    public function validatePassword(UserPassword $password, PasswordHasher $passwordHasher): bool
    {
        return $passwordHasher->verify($password, $this->hashedPassword);
    }

    public function changePassword(UserPassword $password): void
    {

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

}