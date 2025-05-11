<?php

namespace Core;


use Helpers\Log;

class Router
{
    private static array $routes = [];

    public static function get(string $uri, array $action): void
    {
        self::$routes['GET'][rtrim($uri, '/') ?: '/'] = $action;
    }

    public static function post(string $uri, array $action): void
    {
        self::$routes['POST'][rtrim($uri, '/') ?: '/'] = $action;
    }

    public static function dispatch(string $requestUri, string $requestMethod): void
    {
        $uri = rtrim(parse_url($requestUri, PHP_URL_PATH), '/') ?: '/';
        $action = explode('/' , $uri);
        var_dump($action[1]);
        Log::print(self::$routes);
        $action = self::$routes[$requestMethod][$action[1]] ?? null;
        var_dump($action);

        if (!$action) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$controller, $method] = $action;
        $controller = "Controllers\\$controller";

        if (!class_exists($controller)) {
            http_response_code(500);
            echo "Controller $controller not found.";
            return;
        }

        $instance = new $controller();

        if (!method_exists($instance, $method)) {
            http_response_code(500);
            echo "Method $method not found in $controller.";
            return;
        }

        call_user_func([$instance, $method]);
    }
}
