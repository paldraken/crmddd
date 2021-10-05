<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Infrastructure;

use App\Auth\User\Domain\UserPassword;
use App\Auth\User\Infrastructure\PhpUserPasswordHasher;
use PHPUnit\Framework\TestCase;

class PhpPasswordHasherTest extends TestCase
{
    public function test_it_should_generate_user_password()
    {
        $phpPasswordHasher = new PhpUserPasswordHasher();

        $password = new UserPassword('qwerty123');

        $userHashedPwd = $phpPasswordHasher->hash($password->value());

        $isValid = $phpPasswordHasher->verify($password->value(), $userHashedPwd);
        self::assertTrue($isValid, 'Should return TRUE because password is valid');

        $isValid = $phpPasswordHasher->verify('invalid password', $userHashedPwd);
        self::assertFalse($isValid, "Should return FALSE because password isn't valid");
    }
}