<?php

namespace Tests\Unit\DataProviders;

class RightTypeDataProvider
{
    public function listStandardTypeOfString(): array
    {
        return [
            ['bool'],
            ['int'],
            ['float'],
            ['string'],
            ['array'],
            ['object'],
            ['null'],
            ['mixed'],
        ];
    }

    public function listStandardTypeOfClass(): array
    {
        return [
            [ \TypeMoonArray\Types\StdBoolean::class ],
            [ \TypeMoonArray\Types\StdInteger::class ],
            [ \TypeMoonArray\Types\StdFloat::class ],
            [ \TypeMoonArray\Types\StdString::class ],
            [ \TypeMoonArray\Types\StdArray::class ],
            [ \TypeMoonArray\Types\StdObject::class ],
            [ \TypeMoonArray\Types\StdNull::class ],
            [ \TypeMoonArray\Types\StdMixed::class ],
        ];
    }

    public function listStandardTypeOfStringAndClass(): array
    {
        return [
            ['bool'     , \TypeMoonArray\Types\StdBoolean::class ],
            ['int'      , \TypeMoonArray\Types\StdInteger::class ],
            ['float'    , \TypeMoonArray\Types\StdFloat::class ],
            ['string'   , \TypeMoonArray\Types\StdString::class ],
            ['array'    , \TypeMoonArray\Types\StdArray::class ],
            ['object'   , \TypeMoonArray\Types\StdObject::class ],
            ['null'     , \TypeMoonArray\Types\StdNull::class ],
            ['mixed'    , \TypeMoonArray\Types\StdMixed::class ],
        ];
    }
}
