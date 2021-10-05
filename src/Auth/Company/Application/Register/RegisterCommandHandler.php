<?php

declare(strict_types=1);

namespace App\Auth\Company\Application\Register;

use App\Auth\Company\Domain\CompanyName;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserFullName;
use App\Auth\User\Domain\UserPassword;
use App\Shared\Domain\Bus\Command\CommandHandler;

class RegisterCommandHandler implements CommandHandler
{
    public function __construct(
        private RegisterNewCompany $registerNewCompany
    )
    {
    }

    public function __invoke(RegisterCommand $command): RegisterHandlerResponse
    {
        return $this->registerNewCompany->execute(
            new CompanyName($command->companyName()),
            new UserEmail($command->email()),
            new UserFullName($command->contactName()),
            new UserPassword($command->password())
        );
    }

    public static function command(): string
    {
        return RegisterCommand::class;
    }
}