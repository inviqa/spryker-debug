<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model;

class Cast
{
    /**
     * @param mixed $value
     */
    public static function toString($value): string
    {
        return (string)$value;
    }

    /**
     * @param mixed $value
     */
    public static function toStringOrNull($value): ?string
    {
        if ($value === null) {
            return null;
        }

        return (string)$value;
    }

    /**
     * @param mixed $value
     */
    public static function toInt($value): int
    {
        return (int)$value;
    }

    /**
     * @param mixed $value
     */
    public static function toArray($value): array
    {
        return (array)$value;
    }
}
