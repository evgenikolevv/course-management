<?php
require_once '../app/bootstrap.php';
require_once '../app/config/config.ini.php';

use Controllers\AuthController;
use Controllers\SiteController;
use Core\Application;

$app = new Application(APP_ROOT, VIEW_ROOT);

$app->router->get('/', [SiteController::class, 'loadHomePage']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();