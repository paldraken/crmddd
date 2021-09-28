<?php

declare(strict_types=1);

namespace App\Core\Customer\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use Webmozart\Assert\Assert;

final class CustomerEmail extends StringValueObject
{
    public function __construct(string $value)
    {
        Assert::email($value);
        parent::__construct($value);
    }
}