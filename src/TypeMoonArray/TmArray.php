<?php

namespace TypeMoonArray;

use TypeMoonArray\Types\Type;
use TypeMoonArray\Attributes\{
    Publish,
    WritableCheck,
};
use TypeMoonArray\Exceptions\{
    DenyTypeException,
    ClassNotFoundException,
    FunctionNotFoundException,
    MethodNotFoundException,
    NotWritableException,
};
use TypeMoonArray\Utility\Reflection;

class TmArray
{
    private array $standard_types = [
        'bool'      => \TypeMoonArray\Types\StdBoolean::class,
        'int'       => \TypeMoonArray\Types\StdInteger::class,
        'float'     => \TypeMoonArray\Types\StdFloat::class,
        'string'    => \TypeMoonArray\Types\StdString::class,
        'array'     => \TypeMoonArray\Types\StdArray::class,
        'object'    => \TypeMoonArray\Types\StdObject::class,
        'null'      => \TypeMoonArray\Types\StdNull::class,
        'mixed'     => \TypeMoonArray\Types\StdMixed::class,
    ];

    private array $writable_check_methods;

    function __construct(
        protected string $type,
        protected array $array = [],
        protected bool $is_writable = true,
    ) {
        $this->writable_check_methods = $this->collectMethods(
            Publish::class,
            WritableCheck::class,
        );

        $this->initialize( $this->type );
    }

    public function __call( string $method, mixed $args) : ?array
    {
        if ( in_array( $method, $this->writable_check_methods ) ) {
            $this->is_writable ?: throw new NotWritableException;
            return $this->{$method}( ...$args );
        }

        throw new MethodNotFoundException( $method );
    }


    public function initialize( string $type ) : void
    {
        $this->type = $this->convertStringToType( $type );
        $this->normalizeElements();
    }


    public function get( ?string $key = null ) : mixed
    {
        return is_null($key) ? $this->array : $this->array[$key];
    }

    public function getKeys() : array
    {
        return array_keys( $this->array );
    }

    public function getStandardTypeList() : array
    {
        return array_keys( $this->standard_types );
    }


    private function collectMethods( string ...$attribute ) : array
    {
        $reflection = new Reflection( $this );
        return [ ...$reflection->getMethodsWithAttribute( ...$attribute ) ];
    }


    #[Publish, WritableCheck]
    private function convertType( string $type ) : void
    {
        $this->initialize( $type );
    }

    #[Publish, WritableCheck]
    private function closure( \Closure|string $func, mixed ...$args ) : array
    {
        !(is_string( $func ) && !function_exists( $func )) ?: throw new FunctionNotFoundException( $func );

        $this->array = $func( $this->array, ...$args );
        $this->normalizeElements();

        return $this->array;
    }

    #[Publish, WritableCheck]
    private function closureRef( \Closure|string $func, mixed ...$args ) : array
    {
        !(is_string( $func ) && !function_exists( $func )) ?: throw new FunctionNotFoundException( $func );

        $func( $this->array, ...$args );
        $this->normalizeElements();

        return $this->array;
    }


    #[Publish, WritableCheck]
    private function push( mixed $value, ?string $key = null ) : void
    {
        $this->array = array_merge(
            $this->array,
            $this->genArrayToMerge( $value, $key ),
        );
    }

    #[Publish, WritableCheck]
    private function unshift( mixed $value, ?string $key = null ) : void
    {
        $this->array = array_merge(
            $this->genArrayToMerge( $value, $key ),
            $this->array,
        );
    }

    private function genArrayToMerge( mixed $value, ?string $key = null ) : array
    {
        $value = $this->normalizeElement( $value );

        return is_null($key) ? [ $value ] : [ $key => $value ];
    }



    private function isStandardType( ?string $type = null ) : bool
    {
        return in_array( $type ?? $this->type, $this->standard_types );
    }

    private function isStandardTypeAtKey( ?string $type = null ) : bool
    {
        return in_array( $type ?? $this->type, array_keys($this->standard_types) );
    }


    private function convertStringToType( string $type ) : string
    {
        $type = $this->isStandardTypeAtKey( $type ) ? $this->standard_types[$type] : $type;

        class_exists($type) || interface_exists($type) ?: throw new ClassNotFoundException($type);

        return $type;
    }

    private function normalizeElements() : void
    {
        $this->array = array_map(
            fn ($e) => $this->normalizeElement($e),
            $this->array,
        );
    }

    private function normalizeElement( mixed $element ) : mixed
    {
        if ( $this->isStandardType() ) {
            return $this->normalizeStandardElement( $element );
        }

        return $this->normalizeUserClassElement( $element );
    }

    private function normalizeStandardElement( mixed $element ) : mixed
    {
        $this->type::checkType( $element ) ?: throw new DenyTypeException;

        return $this->type::normalizeType( $element );
    }

    private function normalizeUserClassElement( mixed $element ) : mixed
    {
        is_a( $element, $this->type) ?: throw new DenyTypeException;
        
        return $element;
    }
}
