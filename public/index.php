<?php

use Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';

Router::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);