<?php

namespace TypeMoonArray\Exceptions;

class DenyOverwriteAliasException extends \Exception
{
    public function __construct(
        public string $alias = '',
    ) {
        $this->message = "{$alias} is already registered.";
    }
}
