<?php

declare(strict_types=1);

namespace App\Shared\Domain;

interface AggregateRootEquatableInterface
{
    public function equals(AggregateRoot $other): bool;
}