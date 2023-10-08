<?php

declare(strict_types=1);

namespace App\Controllers;

use Tatevik\Framework\Controller;
use Tatevik\Framework\Middleware\AuthMiddleware;

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
