<?php

namespace Controllers;

use Core\Database\Database;
use Core\Log\Log;
use Models\Post;

class HomeController
{
    public function index(): null
    {
        return view('home' , ['title' => 'this is test' , "age" => 20]);
    }

    public function about(): void
    {
        /*$posts = Database::query('select * from post')->allObj();*/
        $posts = Post::update(2 , ['title' => 'updated']);
        Log::print($posts);
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
