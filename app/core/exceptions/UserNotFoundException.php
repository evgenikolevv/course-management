<?php

namespace Core\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{   
    private const USER_IS_NOT_FOUND = 'User with username: %s is not found';
    
    public function __construct($username) {

        $message = sprintf(self::USER_IS_NOT_FOUND, $username);
        parent::__construct($message);
    }
}