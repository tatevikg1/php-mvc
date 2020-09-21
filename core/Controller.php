<?php

namespace app\core;

use app\core\Application;


class Controller
{
    public function render($view, $param = [])
    {
        return Application::$app->router->renderView($view, $param);
    }


}
