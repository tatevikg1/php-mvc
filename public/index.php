<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/autoload/routes.php';

use Tatevik\Framework\Application;
use Tatevik\Framework\Helper;
use Tatevik\Framework\Logger\Facade\Logger;

$dotenv = Dotenv\Dotenv::createImmutable(Helper::basePath());
$dotenv->load();
try {
    $app = new Application();

    $app->run();
} catch (Throwable $t) {
    if ($_ENV['DEBUG'] === 'true') {
        dd($t);
    }
    Logger::debug($t->getMessage());
}


// MESSAGE TO MYSELF

// Run the app from public folder where the index.php is(the program starts with index.php)
// php -S 127.0.0.1:8000
