<?php

// the .. is to go one directory back as index in public directory not root
require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\FormController;
use app\core\Application;



$app = new Application();

$app->router->get('/', 'content');

$app->router->get('/layouts', 'layouts');

$app->router->get('/form', [FormController::class, 'index']);

$app->router->post('/post', [FormController::class, 'store']);


$app->run();
