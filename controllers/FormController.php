<?php

namespace app\controllers;

use app\core\Application;


class FormController
{
    public function index()
    {
        return Application::$app->router->renderView('form');
    }

    public function store()
    {
        return "hello form";
    }
}
