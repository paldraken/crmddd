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

    public static function calculateOrder(?float $prev, ?float $next): float
    {
        if ($prev === null && $next === null) {
            return 1;
        } elseif ($prev === null && is_numeric($next)) {
            return round($next / 2, 12);
        } elseif (is_numeric($prev) && $next === null) {
            return ((int) $prev) + 1;
        } else {
            return round(($prev + $next) / 2, 12);
        }
    }
}