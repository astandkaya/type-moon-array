<?php

namespace Tests\Unit\DataProviders;

class WrongValueDataProvider extends ValueDataProvider
{
    public function listBoolValue() : array
    {
        $list = [
        ];

        return $this->assignKeyToArray( 'bool', $list );
    }

    public function listIntValue() : array
    {
        $list = [
            0.1,
        ];

        return $this->assignKeyToArray( 'int', $list );
    }

    public function listFloatValue() : array
    {
        $list = [
        ];

        return $this->assignKeyToArray( 'float', $list );
    }

    public function listStringValue() : array
    {
        $list = [
        ];

        return $this->assignKeyToArray( 'string', $list );
    }

    public function listArrayValue() : array
    {
        $list = [
            null,
        ];

        return $this->assignKeyToArray( 'array', $list );
    }

    public function listObjectValue() : array
    {
        $list = [
            null,
        ];

        return $this->assignKeyToArray( 'object', $list );
    }

    public function listNullValue() : array
    {
        $list = [
        ];

        return $this->assignKeyToArray( 'null', $list );
    }

    public function listMixedValue() : array
    {
        $list = [
        ];

        return $this->assignKeyToArray( 'mixed', $list );
    }
}
