<?php

use Core\Router;

Router::get('/', ['HomeController', 'index']);
Router::get('about', ['HomeController', 'about']);