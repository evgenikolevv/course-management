<?php

declare(strict_types=1);

namespace Core;

use Core\Request;
use Core\Response;

class Router
{
    private const GET = 'get';
    private const POST = 'post';
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, array $callback) : void
    {
        $this->addHandler(self::GET, $path, $callback);
    }

    public function post(string $path, array $callback) : void
    {
        $this->addHandler(self::POST, $path, $callback);
    }

    private function addHandler(string $httpMethod, string $path, array $callback) : void
    {
        $this->routes[$httpMethod][$path][0] = $callback[0];
        $this->routes[$httpMethod][$path][1] = $callback[1];
    }

    public function resolve() : mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path]?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        
        return call_user_func($callback, $this->request);
    }

    public function renderView(string $view,  array $data = []) : void
    {   
        if (file_exists(VIEW_ROOT . $view . '.php ')) {
            require_once VIEW_ROOT . $view . '.php';
        }     
    }
}