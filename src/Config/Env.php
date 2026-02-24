<?php

declare(strict_types=1);

namespace App\Config;

final class Env
{
    /** @var array<string, string> */
    private static array $values = [];

    public static function load(string $path): void
    {
        if (!is_file($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }

            [$name, $value] = array_pad(explode('=', $trimmed, 2), 2, '');
            $name = trim($name);
            if ($name === '') {
                continue;
            }

            $value = trim($value);
            $value = self::stripQuotes($value);

            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
            putenv(sprintf('%s=%s', $name, $value));
            self::$values[$name] = $value;
        }
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return self::$values[$key] ?? $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }

    private static function stripQuotes(string $value): string
    {
        if ($value === '') {
            return $value;
        }

        $firstChar = $value[0];
        $lastChar = $value[strlen($value) - 1];

        if (($firstChar === '"' && $lastChar === '"') || ($firstChar === "'" && $lastChar === "'")) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
