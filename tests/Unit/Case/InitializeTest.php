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

class InitializeTest extends TestCase
{
    /**
     * @dataProvider \Tests\Unit\DataProviders\RightTypeDataProvider::listStandardTypeOfString
    */
    public function test_TmArrayの宣言が標準の型で可能であること( $type )
    {
        $tm_array = new TmArray( $type );
        
        $this->assertInstanceOf( TmArray::class, $tm_array );
    }

    /**
     * @dataProvider \Tests\Unit\DataProviders\WrongTypeDataProvider::listStandardTypeOfString
    */
    public function test_TmArrayの宣言が存在しない型で不可であること( $type )
    {
        $this->expectException( ClassNotFoundException::class );
        
        $tm_array = new TmArray( $type );
    }

    /**
     *
    */
    public function test_TmArrayの存在しないメソッドが呼び出し不可であること()
    {
        $this->expectException( MethodNotFoundException::class );
        
        $tm_array = new TmArray( 'int' );
        $tm_array->qawsedrftgyhujikolp();
    }
}