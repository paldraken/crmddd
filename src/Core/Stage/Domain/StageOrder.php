<?php

declare(strict_types=1);

namespace App\Core\Stage\Domain;

use App\Shared\Domain\ValueObject\IntValueObject;
use Webmozart\Assert\Assert;

class StageOrder extends IntValueObject
{
    public function __construct(int $value)
    {
        Assert::positiveInteger($value);
        parent::__construct($value);
    }

}