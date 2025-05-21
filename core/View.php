<?php

namespace Core;

use Core\Log\Error;

class View
{
    public static function make(string $view, array $data = []): void
    {
        $viewPath = self::getViewPath($view);

        if (!file_exists($viewPath)) {
            Error::show("view not find $view");
        }

        extract($data);
        include $viewPath;
    }

    private static function getViewPath(string $view): string
    {
        $relativePath = str_replace('.', '/', $view) . '.php';
        return dirname(__DIR__,1) . '/views/' . $relativePath;
    }
}