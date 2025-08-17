<?php
namespace Middlewares;

use Core\Log\Error;
use Models\User;

class AdminMiddleware
{
    public static function handle(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $user = User::find($_SESSION['user_id']);
        if ($user) {
            $_SESSION['isAdmin'] = $user['role'];
        } else {
            header("Location: /login");
            exit;
        }
    }
}
