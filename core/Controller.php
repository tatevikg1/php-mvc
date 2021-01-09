<?php

namespace app\core;

use app\core\Application;
use app\core\middleware\BaseMiddleware;

class Controller
{
    public  $action = '';
    /**
     * @var app\core\middleware\BaseMiddleware[]
     */
    protected  $middlewares = [];


    public function render($view, $param = [])
    {
        return Application::$app->router->renderView($view, $param);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
