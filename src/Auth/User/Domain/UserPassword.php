<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use Webmozart\Assert\Assert;

class UserPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        Assert::minLength($value, 8);
        parent::__construct($value);
    }

}