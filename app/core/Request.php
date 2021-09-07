<?php

declare(strict_types=1);

namespace Core;

class Request
{
    private const URI = 'course-management/';

    public function getPath() : string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = str_replace(self::URI, "", $path);

        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        } 

        return substr($path, 0, $position);
    }

    public function getMethod() : string
    {   
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() : bool
    {
        return $this->getMethod() === 'get';
    }

    public function isPost() : bool
    {
        return $this->getMethod() === 'post';
    }

    public function getBody() : mixed
    {
        $body = [];
        $headers = getallheaders();  
        if(isset($headers[API_HEADER])) {
            return (array)$body = json_decode(file_get_contents("php://input"));
        }
                
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}