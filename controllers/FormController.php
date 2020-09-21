<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

// it extends Controller because the render function is there
class FormController extends Controller
{
    public function index()
    {
        $param = ['data' => 'php-MVC'];
        // return Application::$app->router->renderView('form', $param);
        return $this->render('form', $param);
    }

    public function store(Request $request)
    {
        $data = $request->data();
        var_dump($data);
        return "hello form";
    }
}
