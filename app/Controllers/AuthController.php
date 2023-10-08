<?php

declare(strict_types=1);

namespace App\Controllers;

use Tatevik\Framework\Application;
use Tatevik\Framework\Controller;
use Tatevik\Framework\Request;
use Tatevik\Framework\Session;
use App\Models\LoginUser;
use App\Models\User;


// it extends Controller because the render function is there
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();

        if ($request->method() === "post") {
            // load the request data to the model, so it can be rendered if there was an date_get_last_errors
            // and the user is redirected to the register page with errors
            $user->load($request->data());

            // if the request data was validated in User and the user was registered
            if ($user->validate() && $user->register()) {
                Session::set('user', $user);

                // redirect to the home page after successfully registering the user
                Application::$app->response->redirect('/profile');
            }

        }
        // return Application::$app->router->renderView('register', $param);
        return $this->render('register', ['model' => $user]);
    }

    public function login(Request $request)
    {
        $user = new LoginUser();

        if ($request->method() === "post") {
            $user->load($request->data());

            if ($user->validate() && $user->authenticate())
            {
                Application::$app->response->redirect('/profile');
            }
        }

        return $this->render('login', ['model' => $user]);

    }

    public function logout()
    {
        Session::unset('user');
        // session_destroy();
        // header redirects to the url (in this case '/')
        header('Location: /');
    }
}
