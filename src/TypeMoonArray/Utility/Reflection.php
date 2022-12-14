<?php

namespace TypeMoonArray\Utility;

use ReflectionClass;

class Reflection
{
    private ReflectionClass $reflection;

    public function __construct(
        private object $object,
    ) {
        $this->reflection = new ReflectionClass($this->object);
    }

    public function getMethodsWithAttribute(string ...$attribute_names): iterable
    {
        foreach ($this->reflection->getMethods() as $method) {
            foreach ($method->getAttributes() as $attribute) {
                if (in_array($attribute->getName(), $attribute_names)) {
                    yield $method->name;
                }
            }
        }
    }
}
