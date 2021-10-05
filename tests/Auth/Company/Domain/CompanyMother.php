<?php

declare(strict_types=1);

namespace App\Tests\Auth\Company\Domain;

use App\Auth\Company\Domain\Company;
use App\Auth\Company\Domain\CompanyId;
use App\Auth\Company\Domain\CompanyName;
use DateTimeImmutable;

class CompanyMother
{

    public static function createCompany(
        ?CompanyId         $id = null,
        ?CompanyName       $name = null,
        ?DateTimeImmutable $registeredAt = null
    ): Company
    {
        return new Company(
            $id ?? self::createCompanyId(),
            $name ?? self::createCompanyName(),
            $registeredAt ?? new DateTimeImmutable()
        );
    }

    public static function createCompanyId(?string $id = null): CompanyId
    {
        return $id ? new CompanyId($id) : CompanyId::generate();
    }

    public static function createCompanyName(?string $name = null): CompanyName
    {
        return new CompanyName($name ?? 'My company');
    }
}