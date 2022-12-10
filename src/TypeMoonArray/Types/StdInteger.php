<?php

namespace TypeMoonArray\Types;

class StdInteger implements Type
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
        return (int)$variable;
    }
}