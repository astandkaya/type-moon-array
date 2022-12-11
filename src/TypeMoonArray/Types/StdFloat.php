<?php

namespace TypeMoonArray\Types;

class StdFloat implements Type
{
    function __construct(
    ) {
    }

    public static function checkType( mixed $variable ) : bool
    {
        return $variable == self::normalizeType( $variable );
    }

    public static function normalizeType( mixed $variable ) : mixed
    {
        return (float)$variable;
    }
}
