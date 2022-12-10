<?php

namespace Tests\Unit\DataProviders;

class WrongTypeDataProvider
{
    public function listStandardTypeOfString(): array
    {
        return [
            [true],
            [1],
            [''],
            ['test'],
        ];
    }
}
