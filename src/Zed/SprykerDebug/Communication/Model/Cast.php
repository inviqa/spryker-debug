<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model;

class Cast
{
    public static function toString($value): string
    {
        return (string)$value;
    }

    public static function toStringOrNull($value): ?string
    {
        if ($value === null) {
            return null;
        }

        return (string)$value;
    }

    public static function toInt($value): int
    {
        return (int)$value;
    }

    public static function toArray($value): array
    {
        return (array)$value;
    }
}
