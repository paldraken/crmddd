<?php

declare(strict_types=1);

namespace App\Tests\Auth\User\Domain;

use App\Auth\User\Domain\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function test_it_should_create_validUser_id()
    {
        $userId = new UserId($uuid = UserId::generate()->value());
        self::assertEquals($userId->value(), $uuid);
    }

}