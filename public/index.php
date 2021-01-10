<?php

// the .. is to go one directory back as index in public directory not root
require_once __DIR__.'/../vendor/autoload.php';

use app\core\Application;
use app\controllers\ProfileController;
use app\controllers\AuthController;

$app = new Application();

// session_start();

// homepage
$app->router->get('/', 'content');
$app->router->get('/page1', 'page1');
// routes of profile controller
$app->router->get('/profile',  [ProfileController::class, 'profile']);
// auth routes
$app->router->get   ('/register',   [AuthController::class, 'register']);
$app->router->post  ('/register',   [AuthController::class, 'register']);
$app->router->get   ('/login',      [AuthController::class, 'login']);
$app->router->post  ('/login',      [AuthController::class, 'login']);
$app->router->get   ('/logout',     [AuthController::class, 'logout']);

$app->run();

// MESSAGE TO MYSELF

// Run the app from public folder where the index.php is(the program starts with index.php)
// php -S 127.0.0.1:8000
