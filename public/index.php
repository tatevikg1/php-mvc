<?php

// the .. is to go one directory back as index in public directory not root
require_once __DIR__.'/../vendor/autoload.php';

use app\core\Application;
use app\controllers\FormController;
use app\controllers\AuthController;

$app = new Application();

// session_start();

// homepage
$app->router->get('/', 'content');
$app->router->get('/page1', 'page1');
// auth routes
$app->router->get   ('/register',   [AuthController::class, 'register']);
$app->router->post  ('/register',   [AuthController::class, 'register']);
$app->router->get   ('/login',      [AuthController::class, 'login']);
$app->router->post  ('/login',      [AuthController::class, 'login']);

$app->run();

// MESSAGE TO MYSELF

// Run the app from public folder where the index.php is(the program starts with index.php)
