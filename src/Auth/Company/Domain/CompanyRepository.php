<?php

declare(strict_types=1);

namespace App\Auth\Company\Domain;

interface CompanyRepository
{
    public function save(Company $company): void;

    public function findById(CompanyId $id): ?Company;
}