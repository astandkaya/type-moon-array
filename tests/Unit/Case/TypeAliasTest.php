<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use TypeMoonArray\TmArray;
use TypeMoonArray\Types\StdInteger;
use TypeMoonArray\Types\StdFloat;
use TypeMoonArray\Exceptions\{
    DenyTypeException,
    ClassNotFoundException,
    FunctionNotFoundException,
    MethodNotFoundException,
    NotWritableException,
    DenyOverwriteAliasException,
};

class TypeAliasTest extends TestCase
{
    /**
     *
    */
    public function test_TmArrayのTypeAliasが取得可能であること()
    {
        $aliases = TmArray::getTypeAlias();

        $this->assertTrue( in_array('int', array_keys($aliases)) );
    }

    /**
     *
    */
    public function test_TmArrayのTypeAliasが登録可能であること()
    {
        $key = bin2hex(random_bytes(5));

        TmArray::registerTypeAlias($key, StdInteger::class);
        $aliases = TmArray::getTypeAlias();

        $this->assertTrue( in_array('int', array_keys($aliases)) );
        $this->assertTrue( in_array($key, array_keys($aliases)) );
    }
    
    /**
     *
    */
    public function test_TmArrayのTypeAliasで登録したaliasが使用可能であること()
    {
        $key = bin2hex(random_bytes(5));

        $this->expectException( DenyTypeException::class );

        TmArray::registerTypeAlias($key, StdInteger::class);
        $tm_array = new TmArray( $key, [0.1], false );
    }
    
    /**
     *
    */
    public function test_TmArrayのTypeAliasで上書き登録が出来ないこと()
    {
        $this->expectException( DenyOverwriteAliasException::class );

        TmArray::registerTypeAlias('int', StdInteger::class);
    }
    
    /**
     *
    */
    public function test_TmArrayのTypeAliasで上書きフラグを立てた状態での上書き登録が可能であること()
    {
        TmArray::registerTypeAlias('int', StdFloat::class, true);
        $aliases = TmArray::getTypeAlias();

        $this->assertTrue( $aliases['int'] == StdFloat::class );
    }
    
    /**
     *
    */
    public function test_TmArrayのTypeAliasで存在しないクラスが登録不可であること()
    {
        $key = bin2hex(random_bytes(5));

        $this->expectException( DenyTypeException::class );
        TmArray::registerTypeAlias($key, '');
    }

    /**
     *
    */
    public function test_TmArrayのTypeAliasで非Type型のクラスが登録不可であること()
    {
        $key = bin2hex(random_bytes(5));

        $this->expectException( DenyTypeException::class );
        TmArray::registerTypeAlias($key, self::class);
    }
}
