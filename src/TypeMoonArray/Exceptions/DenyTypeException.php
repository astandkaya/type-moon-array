<?php

namespace TypeMoonArray\Exceptions;

class DenyTypeException extends \Exception
{
    public function __construct()
    {
        $this->message = 'This type is not allowed.';
    }
}
