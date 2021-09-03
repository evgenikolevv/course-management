<?php
declare(strict_types=1);

namespace Core;

use Core\Router;
use Core\Request;
use Core\Response;

class Application
{
    public static string $ROOT_DIR;
    public static string $VIEW_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    
    public function __construct($rootPath, $viewPath)
    {   
        session_start();
        self::$ROOT_DIR = $rootPath;
        self::$VIEW_DIR = $viewPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run() : void
    {
        $this->router->resolve();   
    }
}