<?php

namespace TypeMoonArray\Exceptions;

class NotWritableException extends \Exception
{
    function __construct(
    ) {
        $this->message = 'This array is not allowed to be written.';
    }
}
