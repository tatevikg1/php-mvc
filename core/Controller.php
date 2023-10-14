<?php

declare(strict_types=1);

namespace Tatevik\Framework;

use Tatevik\Framework\Middleware\BaseMiddleware;

/**
 * @var string $action
 * @var array $middlewares
*/
class Controller
{
    public string $action = '';
    protected array $middlewares = [];

    /**
     * renders the view.
     * @param string $view
     * @param array $param
     * @return false|string
    */
    public function render(string $view, array $param = []): bool|string
    {
        return Application::$app->router->renderView($view, $param);
    }

    /**
     * Adds middlewares for controller's middleware array.
     * @param BaseMiddleware $middleware
    */
    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * returns middlewares of the controller
     * @return array 
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
