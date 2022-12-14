<?php

namespace TypeMoonArray\Exceptions;

class MethodNotFoundException extends \Exception
{
    public function __construct(
        public string $method = '',
    ) {
        $this->message = "Specified method [ {$method}() ] not found.";
    }
}
