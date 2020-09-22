<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

// it extends Controller because the render function is there
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $registerModel = new User();
        if($request->method() === "post")
        {
            // load the request data to the model so it can be rerendered if there was an date_get_last_errors
            // and the user is redirected to the register page with errors
            $registerModel->load($request->data());

            // if the request data was validated in User and the user was registrated
            if($registerModel->validate() && $registerModel->register())
            {
                return 'from AuthController';
            }

        }
        // return Application::$app->router->renderView('regiser', $param);
        return $this->render('register', [
            'model' => $registerModel,
        ]);
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
