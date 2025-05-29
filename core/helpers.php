<?php


use Core\View\View;

if (!function_exists('view')) {
    function view(string $view, array $data = []): void
    {
        View::make($view, $data);
    }
}