<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Request;

class SiteController extends Controller
{

    public function loadHomePage() : mixed
    {   
        return $this->render('homepage');
    }
}