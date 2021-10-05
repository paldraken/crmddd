<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\Command;

interface CommandHandler
{
    /**
     * @psalm-return class-string
     */
    public static function command(): string;
}