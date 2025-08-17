<?php

namespace Core\Global;

class Controller
{
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
