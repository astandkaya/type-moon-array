<?php

namespace TypeMoonArray\Types;

class StdMixed implements Type
{
    public function __construct()
    {
    }

    public static function checkType(mixed $variable): bool
    {
        return true;
    }

    public static function normalizeType(mixed $variable): mixed
    {
        return $variable;
    }
}
