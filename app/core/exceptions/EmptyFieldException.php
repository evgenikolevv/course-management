<?php

namespace Core\Exceptions;

use Exception;

class EmptyFieldException extends Exception
{
    private const EMPTY_FIELDS = 'All fields are required';

    public function __construct() {

        parent::__construct(self::EMPTY_FIELDS);
    }
}