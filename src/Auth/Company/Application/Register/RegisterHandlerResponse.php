<?php

declare(strict_types=1);

namespace App\Auth\Company\Application\Register;

use App\Shared\Domain\Bus\Command\CommandResponse;

class RegisterHandlerResponse implements CommandResponse
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}