<?php

declare(strict_types=1);

namespace Tatevik\Framework;

use Exception;
use PDO;

class Application
{
    public $router;
    public $request;
    public $response;
    public $PDO;
    public static $app;
    public $session;
    public $controller;

    public function __construct()
    {
        // make the app accessible in whole application
        self::$app = $this;

        $this->PDO = new PDO('sqlite:/home/t/Documents/github/php-mvc/.sqlite3');
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
    }

    /**
     * runs the application
    */
    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $e) {
            // set the status code of response
            $this->response->setStatusCode($e->getCode());
            // if there was an exception render error page and pass the exception with it
            echo $this->router->renderView('_error', ['exception' => $e]);
        }
    }

    /**
     * determines if the user is authenticated or not
     * @return bool 
    */
    public static function Guest(): bool
    {
        if ($_SESSION['user'] === NULL) {
            return true;
        }
        return false;
    }
}
