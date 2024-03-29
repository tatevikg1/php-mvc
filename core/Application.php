<?php

declare(strict_types=1);

namespace Tatevik\Framework;

use Exception;
use PDO;
use Tatevik\Framework\Database\Connection as DatabaseConnection;
use Tatevik\Framework\Request\Request;
use Tatevik\Framework\Response\Response;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public PDO $PDO;
    public static Application $app;
    public Session $session;
    public Controller $controller;

    public function __construct()
    {
        // make the app accessible in whole application
        self::$app = $this;

        $this->PDO = (new DatabaseConnection())->start();
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
        if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] === NULL) {
            return true;
        }
        return false;
    }
}
