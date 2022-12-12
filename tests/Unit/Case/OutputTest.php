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

class OutputTest extends TestCase
{
    /**
     *
    */
    public function test_TmArrayのarrayプロパティの値を取り出し可能であること()
    {
        $arr = range(1,10);
        $tm_array = new TmArray( 'int', $arr );

        $this->assertEquals(
            $tm_array->get(),
            $arr,
        );
    }

    /**
     *
    */
    public function test_TmArrayのarrayプロパティのキー一覧取り出し可能であること()
    {
        $arr = [ 1=>10, 2=>20, 3=>30, 4=>40, 5=>50 ];
        $tm_array = new TmArray( 'int', $arr );

        $this->assertEquals(
            $tm_array->getKeys(),
            array_keys($arr),
        );
    }

    /**
     *
    */
    public function test_TmArrayのarrayプロパティの値をキー指定で取り出し可能であること()
    {
        $arr = [ 1=>10, 2=>20, 3=>30, 4=>40, 5=>50 ];
        $tm_array = new TmArray( 'int', $arr );

        foreach ($arr as $key => $value) {
            $this->assertEquals(
                $tm_array->get( $key ),
                $value,
            );
        }

    }

    /**
     *
    */
    public function test_標準型の一覧が取得可能であること()
    {
        $list = [
            'bool',
            'int',
            'float',
            'string',
            'array',
            'object',
            'null',
            'mixed',
        ];

        $tm_array = new TmArray( 'int' );

        $this->assertEquals(
            $list,
            $tm_array->getStdTypeAlias(),
        );
    }
}
