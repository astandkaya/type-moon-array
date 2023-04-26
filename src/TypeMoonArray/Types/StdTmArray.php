<?php

namespace TypeMoonArray\Types;

class StdTmArray implements Type
{
    public function __construct()
    {
    }

    public static function checkType(mixed $variable): bool
    {
        return $variable instanceof \TypeMoonArray\TmArray;
    }

    public static function normalizeType(mixed $variable): mixed
    {
        return $variable;
    }
}
