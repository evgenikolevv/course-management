<?php

declare(strict_types=1);

namespace Core;

class Response
{
    public function setStatusCode(int $code) : void
    {
        http_response_code($code);
    }
}