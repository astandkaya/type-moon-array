<?php

namespace TypeMoonArray\Types;

class StdArray implements Type
{
    public function __construct()
    {
    }

    public static function checkType(mixed $variable): bool
    {
        return is_array($variable);
    }

    public static function normalizeType(mixed $variable): mixed
    {
        return $variable;
    }
}
