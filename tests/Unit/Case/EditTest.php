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

class EditTest extends TestCase
{
    /**
     *
    */
    public function test_TmArrayのclosureで関数の実行が可能であること()
    {
        $array = range(1,10);

        $tm_array = new TmArray( 'int', $array );

        $this->assertEquals(
            array_reverse( $array ),
            $tm_array->closure( 'array_reverse' ),
        );
    }

    /**
     *
    */
    public function test_TmArrayのclosureRefで関数の実行が可能であること()
    {
        $array = range(1,10);
        
        $tm_array = new TmArray( 'int', $array );

        array_multisort( $array, SORT_DESC );

        $this->assertEquals(
            $array,
            $tm_array->closureRef( 'array_multisort', SORT_DESC ),
        );
    }

    /**
     *
    */
    public function test_TmArrayのclosureで存在しない関数の実行が不可であること()
    {
        $this->expectException( FunctionNotFoundException::class );

        $tm_array = new TmArray( 'int', range(1,10) );

        $tm_array->closure( 'qawsedrftgyhujikolp' );
    }

    /**
     *
    */
    public function test_TmArrayのclosureRefで存在しない関数の実行が不可であること()
    {
        $this->expectException( FunctionNotFoundException::class );
        
        $tm_array = new TmArray( 'int', range(1,10) );

        $tm_array->closureRef( 'qawsedrftgyhujikolp', SORT_DESC );
    }
    
    /**
     *
    */
    public function test_TmArrayのconvertTypeで変換可能な型の型変換の実行が可能であること()
    {
        $tm_array = new TmArray( 'int', range(1,10) );

        $tm_array->convertType( 'string' );

        foreach ($tm_array->get() as $value) {
            $this->assertTrue( is_string($value) );
        }

    }
    
    /**
     *
    */
    public function test_TmArrayのconvertTypeで変換不可な型の型変換の実行が不可であること()
    {
        $this->expectException( DenyTypeException::class );

        $tm_array = new TmArray( 'int', range(1,10) );

        $tm_array->convertType( 'array' );
    }

}