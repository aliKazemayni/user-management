<?php

use core\Router;
use Dotenv\Dotenv;

session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../core/helpers.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

date_default_timezone_set($_ENV['TIME_ZONE']);

if ($_ENV['APP_DEBUG'] === 'true') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

require_once __DIR__ . '/../core/Middlewares.php';
Router::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);