<?php

namespace app\core\middleware;

use app\core\middleware\BaseMiddleware;
use app\core\Application;
use app\core\exception\ForbiddenException;

/**
 * @param string[] $actions
 * @method void execute()
*/
class AuthMiddleware extends BaseMiddleware
{
    public  $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * If the user is not authenticated throws \app\core\exception\ForbiddenException
    */
    public function execute()
    {
        // if the user is guest
        if(Application::Guest()) {
            // if no extion is specified or the specified action is the current action
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}

