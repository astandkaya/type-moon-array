<?php

namespace TypeMoonArray\Exceptions;

class FunctionNotFoundException extends \Exception
{
    public function __construct(
        public string $function = '',
    ) {
        $this->message = "Specified function [ {$function}() ] not found.";
    }
}
