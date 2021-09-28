<?php

declare(strict_types=1);

namespace App\Auth\Company\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use Webmozart\Assert\Assert;

class CompanyName extends StringValueObject
{
    public function __construct(string $value)
    {
        Assert::minLength($value, 3);
        parent::__construct($value);
    }

}