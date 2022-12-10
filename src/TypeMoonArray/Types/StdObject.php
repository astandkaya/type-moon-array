<?php

namespace TypeMoonArray\Types;

class StdObject implements Type
{
    function __construct(
    ) {
    }

    public static function checkType( mixed $variable ) : bool
    {
        return is_object( $variable );
    }

    public static function normalizeType( mixed $variable ) : mixed
    {
        return $variable;
    }
}