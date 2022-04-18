<?php

declare(strict_types=1);

namespace App\Core\Pipeline\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use Webmozart\Assert\Assert;

class PipelineName extends StringValueObject
{
    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        parent::__construct($value);
    }

}