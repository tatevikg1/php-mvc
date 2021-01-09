<?php

namespace app\core;

use Exception;
use \PDO;

class Application
{
    public $router;
    public $request;
    public $response;
    public $PDO;
    public static $app;
    public $session;

    public function __construct()
    {
        // make the app accesible in whole application
        self::$app = $this;

        $this->PDO = new PDO('sqlite:/home/ta/Documents/php/mvc/.sqlite3');
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->response = new Response();
        $this->session = new Session();
    }

    public function run()
    {
        try{
            echo $this->router->resolve();

        }catch(Exception $e){
            // set the status code of response
            $this->response->setStatusCode($e->getCode());
            // if there was an exception render error page and pass the exception with it
            echo $this->router->renderView('_error', ['exception' => $e]);
        }
    }

    public static function Guest()
    {
        if($_SESSION['user_id'] === NULL){
            return true;
        }
        return false;
    }
}
