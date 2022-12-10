<?php

namespace Tests\Unit\DataProviders;

use Tests\Unit\DummyData\{
    DummyClass,
    DummyAbstractClass,
    DummyInterface,
};

class DummyDataProvider
{
    public function listClassPath(): array
    {
        return [
            [ DummyClass::class, DummyClass::class ],
            [ DummyAbstractClass::class, DummyClass::class ],
            [ DummyInterface::class, DummyClass::class ],
        ];
    }
}
