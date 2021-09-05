<?php
require_once '../app/bootstrap.php';
require_once '../app/config/config.ini.php';

use Controllers\AuthController;
use Controllers\SiteController;
use Controllers\CourseController;
use Core\Application;

$app = new Application(APP_ROOT, VIEW_ROOT);

$app->router->get('/', [SiteController::class, 'loadHomePage']);
$app->router->get('/homepage', [SiteController::class, 'loadHomePage']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/courses', [CourseController::class, 'findAll']);
$app->router->get('/mycourses', [CourseController::class, 'findAllByUserId']);
$app->router->post('/courses', [CourseController::class, 'addCourseToFavourite']);
$app->router->post('/mycourses',[CourseController::class, 'removeCourseFromFavourite']);

$app->run();