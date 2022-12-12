<?php

namespace Tests\Unit\DataProviders;

use Tests\Unit\DummyData\IntOrArrayType;

class DummyDataProvider
{
    public function listClassPath(): array
    {
        return [
            [ IntOrArrayType::class, [1,2,3,[4,5],6,[7,8,9]], ],
        ];
    }

    public function listClosure(): array
    {
        return [
            [ 
                function( $variable ){
                    if ( $variable == (int)$variable ) return true;
                    if ( is_array($variable) ) return true;
                    return false;
                },
                [1,2,3,[4,5],6,[7,8,9]],
            ],
        ];
    }
}
