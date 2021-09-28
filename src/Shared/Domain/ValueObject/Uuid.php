<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as UuidAlias;
use Stringable;
use Webmozart\Assert\Assert;

class Uuid implements Stringable
{
    final function __construct(protected string $value)
    {
        Assert::notFalse(UuidAlias::isValid($this->value));
    }

    public static function generate(): self
    {
        return new static(UuidAlias::uuid4()->toString());
    }

    public function equals(Uuid $uuid): bool
    {
        return $uuid->value() === $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}