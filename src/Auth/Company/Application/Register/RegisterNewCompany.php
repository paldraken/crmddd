<?php

declare(strict_types=1);

namespace App\Auth\Company\Application\Register;

use App\Auth\Company\Domain\Company;
use App\Auth\Company\Domain\CompanyId;
use App\Auth\Company\Domain\CompanyName;
use App\Auth\Company\Domain\CompanyRepository;
use App\Auth\User\Domain\UserPasswordHasher;
use App\Auth\User\Domain\UniqueUserSpecification;
use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserFullName;
use App\Auth\User\Domain\UserId;
use App\Auth\User\Domain\UserPassword;

class RegisterNewCompany
{
    public function __construct(
        private UserPasswordHasher      $passwordHasher,
        private UniqueUserSpecification $uniqueUserSpecification,
        private CompanyRepository       $companyRepository
    )
    {
    }

    public function execute(
        CompanyName $companyName,
        UserEmail $userEmail,
        UserFullName $userFullName,
        UserPassword $userPassword
    ): RegisterHandlerResponse
    {
        $company = Company::create(
            CompanyId::generate(),
            $companyName
        );

        $firstUser = User::create(
            UserId::generate(),
            $company,
            $userEmail,
            $userFullName,
            $userPassword,
            $this->passwordHasher,
            $this->uniqueUserSpecification
        );

        $company->addUser($firstUser);

        $events = array_merge($company->releaseEvents(), $firstUser->releaseEvents());

        $this->companyRepository->save($company);

        return new RegisterHandlerResponse($company->id()->value());
    }
}