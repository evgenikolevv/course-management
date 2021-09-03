<?php

namespace Core\Exceptions;

use Exception;

class UsernameAlreadyTakenException extends Exception
{
    private const USERNAME_IS_TAKEN = 'Username is already taken.';
    
    public function __construct() {

        parent::__construct(self::USERNAME_IS_TAKEN);
    }
}