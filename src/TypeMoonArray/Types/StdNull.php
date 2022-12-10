<?php

namespace TypeMoonArray\Types;

class StdNull implements Type
{
    function __construct(
    ) {
    }

    public static function checkType( mixed $variable ) : bool
    {
        return is_null( $variable ); 
    }

    public static function normalizeType( mixed $variable ) : mixed
    {
        return null;
    }
}