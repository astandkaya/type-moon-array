<?php

namespace Tests\Unit\DummyData;

class IntOrArrayType implements \TypeMoonArray\Types\Type
{
    function __construct(
    ) {
    }

    public static function checkType( mixed $variable ) : bool
    {
        if ( $variable == (int)$variable ) return true;
        if ( is_array($variable) ) return true;
        
        return false;
    }

    public static function normalizeType( mixed $variable ) : mixed
    {
        if ( is_array( $variable ) ) return $variable;

        return (int)$variable;
    }
}
