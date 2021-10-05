<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Domain;

use App\Auth\Company\Domain\Company;
use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserFullName;
use App\Auth\User\Domain\UserHashedPassword;
use App\Auth\User\Domain\UserId;
use App\Auth\User\Domain\UserPassword;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Auth\Company\Domain\CompanyMother;
use DateTimeImmutable;

class UserMother
{
    public static function createUser(
        ?UserId $id = null,
        ?Company $company = null,
        ?UserEmail $userEmail = null,
        ?UserFullName $userFullName = null,
        ?string $hashedPassword= null,
        DateTimeImmutable $createdAt = null
    ): User
    {
        return new User(
            $id ?? self::createUserId(),
            $company ?? CompanyMother::createCompany(),
            $userEmail ?? self::createUserEmail(),
            $userFullName ?? self::createUserFullName(),
            $hashedPassword ?? self::createUserHashedPassword(),
            $createdAt ?? new DateTimeImmutable()
        );
    }

    public static function createUserId(?string $value = null): UserId
    {
        return new UserId($value ?? Uuid::generate()->value());
    }

    public static function createUserEmail(?string $email = null): UserEmail
    {
        return new UserEmail($email ?? 'example@example.com');
    }

    public static function createUserFullName(?string $fullName = null): UserFullName
    {
        return new UserFullName($fullName ?? 'Jhon Doe');
    }

    public static function createUserPassword(?string $pwd = null): UserPassword
    {
        return new UserPassword($pwd ?? "q1w2e3r4");
    }

    public static function createUserHashedPassword(?string $hash = null, ?string $salt = null): string
    {
        return '$2y$10$pJw5qdGK5f44jsosIOc2LuyDl/2wLcAjXO5e5mCA8sNlV6kVnluOO';
    }
}