<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Domain;

use App\Auth\User\Domain\UserFullName;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class UserFullNameTest extends TestCase
{
    public function test_it_should_create_valid_full_user_name()
    {
        $fullName = new UserFullName($nameStr = 'Jhon Lancaster Pek');
        self::assertEquals($fullName->value(), $nameStr);
    }

    public function test_it_should_fire_exception_min_length()
    {
        self::expectException(InvalidArgumentException::class);
        new UserFullName('');
    }
}