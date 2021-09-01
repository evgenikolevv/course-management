<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Request;

class AuthController extends Controller
{

    public function login() : mixed
    {   
        return $this->render('login');
    }

    public function register(Request $request) : mixed
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        
        return $this->render('register');
    }
}