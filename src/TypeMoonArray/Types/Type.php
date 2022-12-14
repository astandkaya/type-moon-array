<?php

namespace TypeMoonArray\Types;

interface Type
{
    public static function checkType(mixed $variable): bool;

    public static function normalizeType(mixed $variable): mixed;
}
