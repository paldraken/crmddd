<?php

declare(strict_types=1);

namespace App\Core\Customer\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use Webmozart\Assert\Assert;

final class CustomerPhone extends StringValueObject
{
    public function __construct(string $value)
    {
        Assert::minLength($value ,3);
        parent::__construct($value);
    }
}