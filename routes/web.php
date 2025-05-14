<?php

use Controllers\HomeController;
use core\Router;

Router::get('/', [HomeController::class, 'index']);
Router::get('about', [HomeController::class, 'about']);
Router::get('about/{id}', [HomeController::class, 'get']);
Router::get('about/{id}/comment', [HomeController::class, 'get']);
Router::get('about/{id}/{test}', [HomeController::class, 'show']);
