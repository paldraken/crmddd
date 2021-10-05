<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Domain;

use App\Auth\User\Domain\UserPassword;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserPasswordTest extends TestCase
{
    public function test_it_should_create_valid_user_password()
    {
        $userPassword = new UserPassword($passStr = 'q1w2e3r4s');
        self::assertEquals($userPassword->value(), $passStr);
    }

    public function test_id_should_file_invalid_password_exception()
    {
        self::expectException(InvalidArgumentException::class);
        new UserPassword('sm');
    }

}