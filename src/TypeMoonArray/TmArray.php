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
    private array $std_type_alias = [
        'bool'      => \TypeMoonArray\Types\StdBoolean::class,
        'int'       => \TypeMoonArray\Types\StdInteger::class,
        'float'     => \TypeMoonArray\Types\StdFloat::class,
        'string'    => \TypeMoonArray\Types\StdString::class,
        'array'     => \TypeMoonArray\Types\StdArray::class,
        'object'    => \TypeMoonArray\Types\StdObject::class,
        'null'      => \TypeMoonArray\Types\StdNull::class,
        'mixed'     => \TypeMoonArray\Types\StdMixed::class,
    ];

    private Reflection $reflection;
    private array $writable_check_methods;

    public function __construct(
        protected \Closure|string $type,
        protected array $array = [],
        protected bool $is_writable = true,
    ) {
        $this->collectMethods();

        if (is_string($this->type)) {
            $this->type = $this->convertStringToType($this->type);
        }

        $this->normalizeElements();
    }

    public function __call(string $method, mixed $args): ?array
    {
        if (in_array($method, $this->writable_check_methods)) {
            $this->is_writable ?: throw new NotWritableException();
            return $this->{$method}(...$args);
        }

        throw new MethodNotFoundException($method);
    }

    private function collectMethods(): void
    {
        $this->reflection = new Reflection($this);

        $this->writable_check_methods = $this->reflection->collectMethods(
            Publish::class,
            WritableCheck::class,
        );
    }


    public function get(?string $key = null): mixed
    {
        return is_null($key) ? $this->array : $this->array[$key];
    }

    public function getKeys(): array
    {
        return array_keys($this->array);
    }

    public function getStdTypeAlias(): array
    {
        return array_keys($this->std_type_alias);
    }


    #[Publish, WritableCheck]
    private function convertType(string $type): void
    {
        $this->type = $this->convertStringToType($type);

        $this->normalizeElements();
    }

    #[Publish, WritableCheck]
    private function closure(\Closure|string $func, mixed ...$args): array
    {
        !(is_string($func) && !function_exists($func)) ?: throw new FunctionNotFoundException($func);

        $this->array = $func($this->array, ...$args);
        $this->normalizeElements();

        return $this->array;
    }

    #[Publish, WritableCheck]
    private function closureRef(\Closure|string $func, mixed ...$args): array
    {
        !(is_string($func) && !function_exists($func)) ?: throw new FunctionNotFoundException($func);

        $func($this->array, ...$args);
        $this->normalizeElements();

        return $this->array;
    }


    #[Publish, WritableCheck]
    private function push(mixed $value, ?string $key = null): void
    {
        $this->array = array_merge(
            $this->array,
            $this->genArrayToMerge($value, $key),
        );
    }

    #[Publish, WritableCheck]
    private function unshift(mixed $value, ?string $key = null): void
    {
        $this->array = array_merge(
            $this->genArrayToMerge($value, $key),
            $this->array,
        );
    }

    private function genArrayToMerge(mixed $value, ?string $key = null): array
    {
        $value = $this->normalizeElement($value);

        return is_null($key) ? [ $value ] : [ $key => $value ];
    }


    private function isStandardType(?string $type = null): bool
    {
        return in_array($type ?? $this->type, array_keys($this->std_type_alias));
    }


    private function convertStringToType(string $type): string
    {
        $type = $this->isStandardType($type) ? $this->std_type_alias[$type] : $type;

        class_exists($type) && is_a(new $type(), Type::class) ?: throw new ClassNotFoundException($type);

        return $type;
    }

    private function normalizeElements(): void
    {
        $this->array = array_map(
            fn ($e) => $this->normalizeElement($e),
            $this->array,
        );
    }

    private function normalizeElement(mixed $element): mixed
    {
        if (is_string($this->type)) {
            return $this->normalizeType($element, $this->type);
        }

        return $this->normalizeClosure($element, $this->type);
    }

    private function normalizeType(mixed $element, string $type): mixed
    {
        $type::checkType($element) ?: throw new DenyTypeException();

        return $type::normalizeType($element);
    }

    private function normalizeClosure(mixed $element, \Closure $type): mixed
    {
        $type($element) ?: throw new DenyTypeException();

        return $element;
    }
}
