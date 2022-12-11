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

class InputTest extends TestCase
{
    /**
     * @dataProvider \Tests\Unit\DataProviders\RightValueDataProvider::listValue
    */
    public function test_TmArrayで許可された型の値がコンストラクタから入力可能であること( $type, $value )
    {
        $tm_array = new TmArray( $type, [$value] );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\WrongValueDataProvider::listValue
    */
    public function test_TmArrayで許可されていない型の値がコンストラクタから入力不可であること( $type, $value )
    {
        $this->expectException( DenyTypeException::class );

        new TmArray( $type, [$value] );
    }


    /**
     * @dataProvider \Tests\Unit\DataProviders\RightValueDataProvider::listValue
    */
    public function test_TmArrayで許可された型の値がpush関数から入力可能であること( $type, $value )
    {
        $key = 'test';

        $tm_array = new TmArray( $type );
        $tm_array->push( $value, $key );

        $this->assertEquals(
            $tm_array->get( $key ),
            $value,
        );

        $array = $tm_array->get();
        $this->assertEquals(
            end( $array ),
            $value,
        );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\WrongValueDataProvider::listValue
    */
    public function test_TmArrayで許可されていない型の値がpush関数から入力不可であること( $type, $value )
    {
        $this->expectException( DenyTypeException::class );

        $tm_array = new TmArray( $type );
        $tm_array->push( $value );
    }

    /**
     *
    */
    public function test_TmArrayのwritableがfalseの時にpush関数が使用できないこと()
    {
        $this->expectException( NotWritableException::class );

        $tm_array = new TmArray( 'int', [], false );
        $tm_array->push( 0 );
    }


    /**
     * @dataProvider \Tests\Unit\DataProviders\RightValueDataProvider::listValue
    */
    public function test_TmArrayで許可された型の値がunshift関数から入力可能であること( $type, $value )
    {
        $key = 'test';

        $tm_array = new TmArray( $type );
        $tm_array->unshift( $value, $key );

        $this->assertEquals(
            $tm_array->get( $key ),
            $value,
        );

        $array = $tm_array->get();
        $this->assertEquals(
            current( $array ),
            $value,
        );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\WrongValueDataProvider::listValue
    */
    public function test_TmArrayで許可されていない型の値がunshift関数から入力不可であること( $type, $value )
    {
        $this->expectException( DenyTypeException::class );

        $tm_array = new TmArray( $type );
        $tm_array->unshift( $value );
    }

    /**
     *
    */
    public function test_TmArrayのwritableがfalseの時にunshift関数が使用できないこと()
    {
        $this->expectException( NotWritableException::class );

        $tm_array = new TmArray( 'int', [], false );
        $tm_array->unshift( 0 );
    }

}
