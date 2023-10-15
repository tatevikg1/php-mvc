<?php

declare(strict_types=1);

namespace Tatevik\Framework\Middleware;

use Tatevik\Framework\Application;
use Tatevik\Framework\Request\Exception\ForbiddenException;

class AuthMiddleware implements BaseMiddleware
{
    public  $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * If the user is not authenticated throws \app\core\exception\ForbiddenException
     * @throws ForbiddenException
     */
    public function execute()
    {
        // if the user is guest
        if (Application::Guest()) {
            // if no exertion is specified or the specified action is the current action
            if (empty($this->actions)
                || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}

