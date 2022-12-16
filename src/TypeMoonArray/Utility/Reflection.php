<?php

namespace TypeMoonArray\Utility;

use ReflectionClass;

class Reflection
{
    private ReflectionClass $reflection;

    protected const METHOD_ATTRIBUTE = 'attributes';
    protected const METHOD_NAME = 'name';

    public function __construct(
        private object $object,
    ) {
        $this->reflection = new ReflectionClass($this->object);
    }

    public function getMethodsWithAttribute(string ...$attribute_names): iterable
    {
        $methods = $this->convertToArrayOfNamesAndAttributes();

        foreach ($methods as $method) {
            if (array_intersect($method[self::METHOD_ATTRIBUTE], $attribute_names) === $attribute_names) {
                yield $method[self::METHOD_NAME];
            }
        }
    }

    public function convertToArrayOfNamesAndAttributes(): array
    {
        return array_map(
            fn ($method) => [
                self::METHOD_NAME => $method->getName(),
                self::METHOD_ATTRIBUTE => array_map(
                    fn ($attribute) => $attribute->getName(),
                    $method->getAttributes(),
                ),
            ],
            $this->reflection->getMethods(),
        );
    }
}
