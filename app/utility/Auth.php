<?php

declare(strict_types=1);

namespace Utility;

class Auth 
{
    public static function isLoggedIn() : bool
    {
        return isset($_SESSION['user']);
    }

    public static function setUser($user) : void
    {
        $_SESSION['user'] = $user;
    }

    public static function authenticate($params, $user) : bool
    {   
        if ($params['username'] == $user['username'] &&
            password_verify($params['password'], $user['password'])) {
                return true;
        }

        return false;
    }

    public static function unsetUser() : void
    {
        unset($_SESSION['user']);
    }
}