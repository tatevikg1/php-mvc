<?php

namespace app\core;

use app\core\Application;
use app\core\middleware\BaseMiddleware;


/**
 * @var string $action
 * @var array $middlewares
 * @method \app\core\Application render($view, $param = [])
 * @method void registerMiddleware(BaseMiddleware $middleware)
 * @method array getMiddlewares()
*/
class Controller
{
    public  $action = '';
    /**
     * @var app\core\middleware\BaseMiddleware[]
     */
    protected  $middlewares = [];


    /**
     * renders the view.
     * @param string $view
     * @param array $param
     * @return app\core\Application
    */
    public function render($view, $param = [])
    {
        return Application::$app->router->renderView($view, $param);
    }

    /**
     * Adds middlewares for controller's middleware array.
     * @param app\core\BaseMiddleware $middleware
    */
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * returns middlewares of the controller
     * @return array 
    */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
