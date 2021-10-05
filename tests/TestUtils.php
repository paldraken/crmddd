<?php

declare(strict_types=1);

namespace App\Tests;
use function Functional\some;

class TestUtils
{
    /**
     * @param array $array
     * @psalm-param array<int, object> $array
     * @param string $class
     * @psalm-param class-string $class
     * @return bool
     */
    public static function containsInstanceOf(array $array, string $class): bool
    {
        return some($array, fn($item) => $item instanceof $class);
    }
}