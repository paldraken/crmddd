<?php

declare(strict_types=1);

namespace App\Core\Customer\Infrastructure\Persistence\Doctrine;

use App\Core\Customer\Domain\CustomerId;
use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;

class CustomerIdType extends UuidType
{
    const TYPE_NAME = 'customer_id';

    function typeClass(): string
    {
        return CustomerId::class;
    }

    public function getName()
    {
        return self::TYPE_NAME;
    }


}