<?php

declare(strict_types=1);

namespace App\Auth\Company\Infrastructure\Persistence;

use App\Auth\Company\Domain\Company;
use App\Auth\Company\Domain\CompanyId;
use App\Auth\Company\Domain\CompanyRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCompanyRepository extends DoctrineRepository implements CompanyRepository
{
    public function save(Company $company): void
    {
        $this->persist($company);
    }

    public function findById(CompanyId $id): ?Company
    {
        return $this->repository(Company::class)->find($id);
    }
}