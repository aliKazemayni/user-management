<?php

namespace Controllers;

use Core\Log;

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

    public function show($id,$tset): void
    {
        Log::dump($id);
        Log::dump($tset);
    }
    public function get($id): void
    {
        echo "get one : ";
        Log::dump($id);
    }
}
