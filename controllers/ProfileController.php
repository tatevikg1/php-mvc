<?php

namespace app\controllers;

use app\core\Controller;
use app\core\middleware\AuthMiddleware;


/**
 * @method view profile()
 * 
 * Extends Controller because the render, registerMiddleware functions are in Controller class
*/
class ProfileController extends Controller
{
    /**
     * Registers AuthMiddleware for profile route
    */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    
    public function profile()
    {      
        return $this->render('profile');
    }
}
