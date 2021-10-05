<?php

declare(strict_types=1);

namespace App\Auth\Company\Application\Register;

use App\Shared\Domain\Bus\Command\Command;

class RegisterCommand implements Command
{
    public function __construct(
        private ?string $companyName,
        private ?string $contactName,
        private ?string $email,
        private ?string $password,
        private ?string $phone,
    )
    {
    }

    public function password(): string
    {
        return $this->password;
    }

    public function companyName(): string
    {
        return $this->companyName;
    }

    public function contactName(): string
    {
        return $this->contactName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

}