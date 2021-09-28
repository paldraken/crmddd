<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Persistence\Doctrine;

use App\Auth\User\Domain\UserId;
use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class UserIdType extends UuidType
{
    const TYPE_NAME = 'user_id';

    function typeClass(): string
    {
        return UserId::class;
    }

    public function getName(): string
    {
        return self::TYPE_NAME;
    }

}