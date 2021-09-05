<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class SiteController extends Controller
{   
    public function loadHomePage() : mixed
    {   
        return $this->render('homepage');
    }
}