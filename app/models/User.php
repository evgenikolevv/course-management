<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use Core\Exceptions\UserNotFoundException;
use Core\Exceptions\InvalidArgumentException;
use Core\Exceptions\UsernameAlreadyTakenException;
use Core\Exceptions\EmptyFieldException;

class User
{
    private Database $handler;

    private const FIND_BY_USERNAME = "SELECT username, password, first_name, last_name FROM users WHERE username =:username";

    private const CHECK_IF_USERNAME_IS_TAKEN = "SELECT username FROM users WHERE username = :username;";

    private const INSERT_USER = "INSERT INTO users(username,password,first_name,last_name) 
                                 VALUES(:username,:password,:first_name,:last_name)";

    public function __construct()
    {
        $this->handler = new Database();
    }

    public function findByUsername(string $username) : mixed
    {   
        if (!isset($username) || empty($username)) {
            
            throw new InvalidArgumentException();
        }

        $this->handler->query(self::FIND_BY_USERNAME);
        $this->handler->bind(':username',$username);

        $user = $this->handler->fetch();

        if (!$user) {
            throw new UserNotFoundException($username);
        }

        return $user;
    }

    public function save($user) : void
    {   
        if (!isset($user['username']) || empty($user['username']) || !isset($user['password']) || empty($user['password'])
            || !isset($user['firstname']) || empty($user['firstname']) || !isset($user['lastname']) || empty($user['lastname'])) {
            
            throw new EmptyFieldException();
        }

        $this->checkIfUsernameIsTaken($user['username']);
        
        $this->handler->query(self::INSERT_USER);
        $this->handler->bind(':username',$user['username']);
        $this->handler->bind(':password', password_hash($user['password'], PASSWORD_BCRYPT));
        $this->handler->bind(':first_name',$user['firstname']);
        $this->handler->bind(':last_name', $user['lastname']);

        $this->handler->execute();
    }

    private function checkIfUsernameIsTaken($username) : bool
    {   
        $this->handler->query(self::CHECK_IF_USERNAME_IS_TAKEN);
        $this->handler->bind(':username', $username);

        $isTaken = $this->handler->fetchBool();

        if($isTaken)
        {
            throw new UsernameAlreadyTakenException();
        }

        return false;
    }
}