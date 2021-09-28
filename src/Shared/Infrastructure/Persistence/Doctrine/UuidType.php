<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

abstract class UuidType extends StringType
{
    /**
     * @return class-string
     */
    abstract function typeClass(): string;

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $typeClass = $this->typeClass();
        return new $typeClass($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var Uuid $value */
        return $value->value();
    }

}