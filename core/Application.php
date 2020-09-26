<?php

namespace app\core;

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
        echo $this->router->resolve();
    }

    public static function Guest()
    {
        if($_SESSION['user_id'] === NULL){
            return true;
        }
        return false;
    }
}
