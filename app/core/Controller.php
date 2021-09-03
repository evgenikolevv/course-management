<?php

declare(strict_types=1);

namespace Core;

use Core\Application;

class Controller
{   
    
    protected function render(string $view, array $data = []) : mixed
    {
        return Application::$app->router->renderView($view,$data);
    }
}