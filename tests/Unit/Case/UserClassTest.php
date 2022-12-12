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
use Tests\Unit\DummyData\IntOrArrayType;

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
    public function test_TmArrayでユーザー定義のクラスを指定したときにコンストラクタで代入可能であること( $class, $elements )
    {
        $tm_array = new TmArray( $class, $elements );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクラスを指定したときにpushで代入可能であること( $class, $elements )
    {
        $tm_array = new TmArray( $class );

        foreach ($elements as $element) {
            $tm_array->push( $element );
        }
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクラスを指定したときにunshiftで代入可能であること( $class, $elements )
    {
        $tm_array = new TmArray( $class );

        foreach ($elements as $element) {
            $tm_array->unshift( $element );
        }
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }


    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClosure
    */
    public function test_TmArrayでユーザー定義のクロージャを指定可能であること( $closure )
    {
        $tm_array = new TmArray( $closure );
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClosure
    */
    public function test_TmArrayでユーザー定義のクロージャを指定したときにコンストラクタで代入可能であること( $closure, $elements )
    {
        $tm_array = new TmArray( $closure, $elements );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクロージャを指定したときにpushで代入可能であること( $class, $elements )
    {
        $tm_array = new TmArray( $class );

        foreach ($elements as $element) {
            $tm_array->push( $element );
        }
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\DummyDataProvider::listClassPath
    */
    public function test_TmArrayでユーザー定義のクロージャを指定したときにunshiftで代入可能であること( $class, $elements )
    {
        $tm_array = new TmArray( $class );

        foreach ($elements as $element) {
            $tm_array->unshift( $element );
        }
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }
}
