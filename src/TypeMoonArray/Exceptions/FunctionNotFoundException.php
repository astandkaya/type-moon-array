<?php

namespace TypeMoonArray\Exceptions;

class FunctionNotFoundException extends \Exception
{
    function __construct(
        public string $function = '',
    ) {
        $this->message = "Specified function [ {$function}() ] not found.";
    }
}
