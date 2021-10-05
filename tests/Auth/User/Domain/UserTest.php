<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Domain;

use App\Auth\User\Domain\Events\UserWasCreatedDomainEvent;
use App\Auth\User\Domain\UserPasswordHasher;
use App\Auth\User\Domain\UniqueUserSpecification;
use App\Auth\User\Domain\User;
use App\Tests\Auth\Company\Domain\CompanyMother;
use App\Tests\TestUtils;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_it_should_create_valid_user()
    {
        $user = User::create(
            $id = UserMother::createUserId(),
            $company = CompanyMother::createCompany(),
            $email = UserMother::createUserEmail(),
            $fullName = UserMother::createUserFullName(),
            $password = UserMother::createUserPassword(),
            $this->mockPasswordHasher(),
            $this->mockUniqueUserSpecification()
        );

        self::assertEquals($user->id()->value(), $id->value());
        self::assertEquals($user->company()->id()->value(), $company->id()->value());
        self::assertEquals($user->email()->value(), $email->value());
        self::assertEquals($user->fullName()->value(), $fullName->value());
        self::assertNotEmpty($user->createdAt());

        $events = $user->releaseEvents();

        self::assertTrue(TestUtils::containsInstanceOf($events, UserWasCreatedDomainEvent::class));
    }

    private function mockPasswordHasher(): UserPasswordHasher
    {
        return $this->getMockBuilder(UserPasswordHasher::class)->getMock();
    }

    private function mockUniqueUserSpecification(): UniqueUserSpecification
    {
        $stub = self::createMock(UniqueUserSpecification::class);
        $stub->method('isSatisfiedBy')->willReturn(true);

        return $stub;
    }
}