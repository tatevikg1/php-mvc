<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

// it extends Controller because the render function is there
class AuthController extends Controller
{
    public function register(Request $request)
    {
        if($request->method() === "get")
        {
            return $this->render('register');
        }



        return "handle post method";
    }

    public function login(Request $request)
    {
        if($request->method() === "get")
        {
            return $this->render('login');
        }

        return "handle post method";

    }
}
