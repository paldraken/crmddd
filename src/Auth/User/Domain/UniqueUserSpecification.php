<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

interface UniqueUserSpecification
{
    public function isSatisfiedBy(UserEmail $email): bool;
}