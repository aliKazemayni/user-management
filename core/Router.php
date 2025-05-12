<?php

namespace Core;

use Helpers\Log;

class Router
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function get(string $uri, array $action): void
    {
        self::addRoute('GET', $uri, $action);
    }

    public static function post(string $uri, array $action): void
    {
        self::addRoute('POST', $uri, $action);
    }

    private static function addRoute(string $method, string $uri, array $action): void
    {
        $uri = '/' . trim($uri, '/');

        preg_match_all('/\{(\w+)\}/', $uri, $matches);
        $paramNames = $matches[1] ?? [];

        $regex = preg_replace('/\{(\w+)\}/', '([^/]+)', $uri);
        $regex = '#^' . $regex . '$#';

        self::$routes[$method][] = [
            'pattern' => $regex,
            'action' => $action,
            'params' => $paramNames,
        ];
    }

    public static function dispatch(string $requestUri, string $requestMethod): void
    {
        $uri = '/' . trim(parse_url($requestUri, PHP_URL_PATH), '/');

        foreach (self::$routes[$requestMethod] ?? [] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches); // حذف full match
                $paramNames = $route['params'];

                if (count($paramNames) !== count($matches)) {
                    Log::error("Route parameter count mismatch", false);
                    return;
                }

                $params = array_combine($paramNames, $matches);
                $params = array_map('urldecode', $params);
                $params = array_values($params);

                [$controllerClass, $method] = $route['action'];

                if (!class_exists($controllerClass)) {
                    Log::error("Controller not found: $controllerClass", false);
                    return;
                }

                $controller = new $controllerClass();

                if (!method_exists($controller, $method)) {
                    Log::error("Method not found: $method in controller $controllerClass", false);
                    return;
                }

                call_user_func_array([$controller, $method], $params);
                return;
            }
        }

        Log::error("404 - Page not found");
    }
}
