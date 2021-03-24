<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\middleware\AuthMiddleware;

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
