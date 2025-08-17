<?php

namespace Controllers;

use Core\Global\Controller;
use Core\View\View;
use Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $q = $_GET['q'] ?? '';

        if ($q) {
            $users = User::search(trim($q));
        } else {
            $users = User::all();
        }

        View::make('web.home', [
            'users' => $users,
            'q' => $q
        ]);
    }
}
