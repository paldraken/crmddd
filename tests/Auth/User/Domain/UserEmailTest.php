<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Domain;


use App\Auth\User\Domain\UserEmail;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserEmailTest extends TestCase
{
    public function test_it_should_create_valid_user_email()
    {
        $email = new UserEmail($emailStr = 'example@example.com');
        self::assertEquals($email->value(), $emailStr);
    }

    public function test_id_should_fire_invalid_email_exception()
    {
        self::expectException(InvalidArgumentException::class);
        new UserEmail('examplecom');
    }

}