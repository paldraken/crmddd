<?php

namespace App\Shared\Domain\Bus\Query;

interface QueryHandler
{
    /**
     * @psalm-return class-string
     */
    public static function forQuery(): string;
}