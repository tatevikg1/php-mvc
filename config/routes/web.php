<?php

use App\Controllers\ProfileController;
use Tatevik\Framework\Router;

Router::get('/',      'content');
Router::get('/page1', 'page1');
Router::get('/profile',  [ProfileController::class, 'profile']);

