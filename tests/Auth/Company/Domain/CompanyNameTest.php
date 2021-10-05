<?php

declare(strict_types=1);

namespace App\Tests\Auth\Company\Domain;

use App\Auth\Company\Domain\Company;
use App\Auth\Company\Domain\CompanyName;
use PHPUnit\Framework\TestCase;

class CompanyNameTest extends TestCase
{
    public function test_it_should_create_valid_company_name()
    {
        $name = new CompanyName($strName = 'Test name');

        self::assertEquals($name->value(), $strName);
    }

}