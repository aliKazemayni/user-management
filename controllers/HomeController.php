<?php

namespace Controllers;

class HomeController
{
    public function index(): void
    {
        echo "🏠 صفحه اصلی وبلاگ";
    }

    public function about(): void
    {
        echo "ℹ️ درباره ما";
    }
}
