<?php

declare(strict_types=1);

namespace Core;

use Core\Application;
use Utility\Auth;

class Controller
{   
    protected function render(string $view, array $data = []) : mixed
    {   
        if ($view != 'login' && $view != 'register' && !Auth::isLoggedIn()) {
            return Application::$app->router->renderView('login',$data);
        }

        return Application::$app->router->renderView($view,$data);
    }
}