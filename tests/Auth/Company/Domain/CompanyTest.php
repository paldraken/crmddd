<?php

declare(strict_types=1);

namespace App\Tests\Auth\Company\Domain;

use App\Auth\Company\Domain\Company;
use App\Auth\Company\Domain\Events\CompanyWasRegisteredDomainEvent;
use App\Auth\User\Domain\User;
use App\Tests\Auth\User\Domain\UserMother;
use App\Tests\TestUtils;
use PHPUnit\Framework\TestCase;
use function Functional\some;

class CompanyTest extends TestCase
{
    public function test_it_should_create_valid_company()
    {
        $company = Company::create(
            $id = CompanyMother::createCompanyId(),
            $name = CompanyMother::createCompanyName()
        );

        self::assertTrue($company->id()->equals($id));
        self::assertTrue($company->name()->equals($name));

        $events = $company->releaseEvents();

        self::assertTrue(TestUtils::containsInstanceOf($events, CompanyWasRegisteredDomainEvent::class));
    }

    public function test_it_should_be_add_user()
    {
        $company = CompanyMother::createCompany();
        $user = UserMother::createUser();

        $company->addUser($user);

        $userFound = some($company->users(), fn(User $u) => $u->equals($user));

        self::assertTrue($userFound, "Test user hasn't been added to the company.");
    }

}