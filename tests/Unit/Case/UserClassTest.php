<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use TypeMoonArray\TmArray;
use TypeMoonArray\Exceptions\{
    DenyTypeException,
    ClassNotFoundException,
    FunctionNotFoundException,
    MethodNotFoundException,
    NotWritableException,
};
use Tests\Unit\DummyData\{
    DummyClass,
    DummyAbstractClass,
    DummyInterface,
};

class UserClassTest extends TestCase
{
    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクラスが指定可能であること( $class )
    {
        $tm_array = new TmArray( $class );
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクラスがコンストラクタで代入可能であること( $class, $instance )
    {
        $dummy = new $instance();

        $tm_array = new TmArray( $class, [$dummy] );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクラスがpushで代入可能であること( $class, $instance )
    {
        $dummy = new $instance();

        $tm_array = new TmArray( $class );
        $tm_array->push( $dummy );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクラスがunshiftで代入可能であること( $class, $instance )
    {
        $dummy = new $instance();

        $tm_array = new TmArray( $class );
        $tm_array->unshift( $dummy );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }
}
