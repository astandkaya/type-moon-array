<?php

namespace Tests\Unit\DataProviders;

class RightValueDataProvider extends ValueDataProvider
{
    public function listBoolValue() : array
    {
        $list = [
            true,
            false,
            'true',
            'false',
            0,
            1,
        ];

        return $this->assignKeyToArray( 'bool', $list );
    }

    public function listIntValue() : array
    {
        $list = [
            -1,
            0,
            1,
            100_000_000,
            1.0,
            false,
            true,
            '1',
        ];

        return $this->assignKeyToArray( 'int', $list );
    }

    public function listFloatValue() : array
    {
        $list = [
            -1,
            0,
            1,
            100_000_000,
            1.0,
            false,
            true,
            '1',
            -0.1,
            0.1,
            '0.1',
        ];

        return $this->assignKeyToArray( 'float', $list );
    }

    public function listStringValue() : array
    {
        $list = [
            'test',
            '',
            0,
            0.1,
        ];

        return $this->assignKeyToArray( 'string', $list );
    }

    public function listArrayValue() : array
    {
        $list = [
            [],
            [0,0],
        ];

        return $this->assignKeyToArray( 'array', $list );
    }

    public function listObjectValue() : array
    {
        $list = [
            (object)[],
        ];

        return $this->assignKeyToArray( 'object', $list );
    }

    public function listNullValue() : array
    {
        $list = [
            null,
        ];

        return $this->assignKeyToArray( 'null', $list );
    }

    public function listMixedValue() : array
    {
        $list = [
            true,
            false,
            -1,
            0,
            1,
            100_000_000,
            1.0,
            false,
            true,
            '1',
            -0.1,
            0.1,
            '0.1',
            'test',
            '',
            [],
            [0,0],
            (object)[],
            null,
        ];

        return $this->assignKeyToArray( 'mixed', $list );
    }
}
