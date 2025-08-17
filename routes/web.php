<?php

use Controllers\AuthController;
use Controllers\HomeController;
use Core\Router;

Router::get('/dashboard' , [HomeController::class , 'index']);

Router::get('/register', [AuthController::class, 'registerForm']);
Router::post('/register', [AuthController::class, 'register']);

Router::get('/login', [AuthController::class, 'loginForm']);
Router::post('/login', [AuthController::class, 'login']);

Router::get('/logout', [AuthController::class, 'logout']);