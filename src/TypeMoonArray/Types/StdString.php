<?php

namespace TypeMoonArray\Types;

class StdString implements Type
{
    public function __construct()
    {
    }

    public static function checkType(mixed $variable): bool
    {
        return $variable == self::normalizeType($variable);
    }

    public static function normalizeType(mixed $variable): mixed
    {
        return (string)$variable;
    }
}
