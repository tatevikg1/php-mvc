<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/autoload/routes.php';

use Tatevik\Framework\Application;
use Tatevik\Framework\Helper;

$dotenv = Dotenv\Dotenv::createImmutable(Helper::basePath());
$dotenv->load();

$app = new Application();

$app->run();

// MESSAGE TO MYSELF

// Run the app from public folder where the index.php is(the program starts with index.php)
// php -S 127.0.0.1:8000
