<?php

declare(strict_types=1);

namespace App\Auth\Company\Infrastructure\Persistence\Doctrine;

use App\Auth\Company\Domain\CompanyId;
use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CompanyIdType extends UuidType
{
    const TYPE_NAME = 'company_id';

    function typeClass(): string
    {
        return CompanyId::class;
    }

    public function getName(): string
    {
        return self::TYPE_NAME;
    }
}