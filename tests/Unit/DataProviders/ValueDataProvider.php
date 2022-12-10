<?php

namespace Tests\Unit\DataProviders;

abstract class ValueDataProvider
{
    public function listValue() : array
    {
        return [
            ...$this->listBoolValue(),
            ...$this->listIntValue(),
            ...$this->listFloatValue(),
            ...$this->listStringValue(),
            ...$this->listArrayValue(),
            ...$this->listObjectValue(),
            ...$this->listNullValue(),
            ...$this->listMixedValue(),
        ];
    }

    abstract public function listBoolValue() : array;
    abstract public function listIntValue() : array;
    abstract public function listFloatValue() : array;
    abstract public function listStringValue() : array;
    abstract public function listArrayValue() : array;
    abstract public function listObjectValue() : array;
    abstract public function listNullValue() : array;
    abstract public function listMixedValue() : array;

    public function assignKeyToArray( string $type, array $values) : array
    {
        $ret = [];
        foreach ($values as $value) $ret[] = [ $type, $value ];

        return $ret;
    }
}
