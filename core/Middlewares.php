<?php

use Middlewares\AdminMiddleware;
use Middlewares\AuthMiddleware;

if (!in_array($_SERVER['REQUEST_URI'], ['/login', '/register'])) {
    AuthMiddleware::handle();
    AdminMiddleware::handle();
}


