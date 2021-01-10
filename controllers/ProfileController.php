<?php

namespace app\controllers;

use app\core\Controller;
use app\core\middleware\AuthMiddleware;

// it extends Controller because the render function is there
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function profile()
    {      
        return $this->render('profile');
    }
}
