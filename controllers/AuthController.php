<?php

namespace Controllers;

use Core\Global\Controller;
use Core\Global\Session;
use Core\View\View;
use Core\Log\Error;
use Models\User;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        $msg = Session::get('msg');
        View::make('auth.login' , ['msg' => $msg]);
    }
    public function registerForm(): void
    {
        $msg = Session::get('msg');
        View::make('auth.register', ['msg' => $msg]);
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            Error::show("Email and password are required.");
        }

        $user = User::findOne('email', $email);

        if (!$user || !password_verify($password, $user['password'])) {
            Error::show("Invalid credentials.");
        }

        Session::set('user_id', $user['id']);
        $this->redirect('/dashboard');
    }

    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $exists = User::findOne('email', $email);
        if ($exists) {
            Session::set('msg' , 'This username already exists!');
            $this->redirect('/register');
        }

        User::create([
            'email' => $email,
            'name' => $email,
            'password' => password_hash($password , PASSWORD_BCRYPT),
        ]);

        Session::set('msg' , 'Registration successful! You can login now.');
        $this->redirect('/login');
    }

    public function logout(): void
    {
        Session::destroy();
        $this->redirect('/login');
    }
}
