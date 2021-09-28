<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use DateTimeInterface;
use InvalidArgumentException;

final class Util
{
    public static function dateToStr(DateTimeInterface $dateTime): string
    {
        return $dateTime->format(DateTimeInterface::ATOM);
    }

    public static function generateRandomString(int $length = 32): string
    {
        if ($length < 1) {
            throw new InvalidArgumentException();
        }
        return substr(strtr(base64_encode(random_bytes($length)), '+/', '-_'), 0, $length);
    }
}