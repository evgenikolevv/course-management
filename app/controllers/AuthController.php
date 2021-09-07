<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Exceptions\EmptyFieldException;
use Core\Exceptions\UserNotFoundException;
use Core\Exceptions\InvalidArgumentException;
use Core\Exceptions\UsernameAlreadyTakenException;
use Core\Request;
use Models\User;
use Utility\Auth;

class AuthController extends Controller
{
    private User $userModel;

    private array $params = [
        'id' => '',
        'username' => '',
        'password' => '',
        'firstname' => '',
        'lastname' => ''
    ];

    private array $data = [
        'error' => ''
    ];

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login(Request $request) : mixed
    {   
        if (Auth::isLoggedIn()) {
            return $this->render('homepage');
        }

        if ($request->isPost()) {
            $body = $request->getBody();
           
            $this->params = [
                'username' => $body['username'],
                'password' => $body['password']
            ];

            try {
                $user = [];
                $user = $this->userModel->findByUsername($this->params['username']);
                
                if (!Auth::authenticate($this->params, $user)) {
                    return $this->setData('login', 'Invalid username or password');
                }
            
            Auth::setUser($user);
            return $this->render('homepage');

            } catch(InvalidArgumentException $exception) {
                return $this->setData('login',$exception->getMessage() );
            } catch(UserNotFoundException $exception) {
                return $this->setData('login',$exception->getMessage() );
            }
        }

        return $this->render('login');
    }

    public function register(Request $request) : mixed
    {
        if ($request->isPost()) {
            $body = $request->getBody();
            $this->params = [
                'username' => $body['username'],
                'password' => $body['password'],
                'firstname' => $body['firstname'],
                'lastname' => $body['lastname']
            ];

            try{
                $this->userModel->save($this->params);
                return $this->render('login');
                
            }catch(EmptyFieldException $exception) {
                return $this->setData('register', $exception->getMessage());
            }catch(UsernameAlreadyTakenException $exception) {
                return $this->setData('register', $exception->getMessage());
            }
        }
        
        return $this->render('register');
    }

    public function logout() : mixed
    {
        Auth::unsetUser();
        return $this->render('login');
    }

    private function setData($view, $error)
    {   
        $this->data['error'] = $error;
        return $this->render($view, $this->data);
    }

}