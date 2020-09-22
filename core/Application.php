<?php

namespace app\core;

class Application
{

    public $router;
    public $request;
    public $response;
    public $db;
    public static $app;

    public function __construct()//$config)
    {
        // make the app accesible in whole application
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->response = new Response();
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
