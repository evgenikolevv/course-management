<?php

namespace Core\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{   
    private const INVALID_ARGUMENTS = 'Invalid username or password';

    public function __construct() {

        parent::__construct(self::INVALID_ARGUMENTS);
    }
}