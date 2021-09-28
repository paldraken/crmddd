<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use Webmozart\Assert\Assert;

class UserEmail extends StringValueObject
{
    public function __construct(string $value)
    {
        Assert::email($value);
        parent::__construct($value);
    }

}