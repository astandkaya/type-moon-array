<?php

namespace TypeMoonArray\Exceptions;

class ClassNotFoundException extends \Exception
{
    public function __construct(
        public string $class = '',
    ) {
        $this->message = "Specified class [ {$class} ] not found.";
    }
}
