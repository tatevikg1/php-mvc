<?php

// auth routes
use App\Controllers\AuthController;
use Tatevik\Framework\Router;

Router::get('/register',   [AuthController::class, 'register']);
Router::post('/register',   [AuthController::class, 'register']);
Router::get('/login',      [AuthController::class, 'login']);
Router::post('/login',      [AuthController::class, 'login']);
Router::get('/logout',     [AuthController::class, 'logout']);