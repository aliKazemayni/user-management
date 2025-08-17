<?php

namespace Controllers;

use Core\Global\Controller;
use Core\Global\Session;
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

    public function update($id)
    {

        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;

        $user = User::find($id);
        if (!$user) {
            die("User not found");
        }

        if (!empty($_FILES['avatar']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/avatars/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmp = $_FILES['avatar']['tmp_name'];
            $fileName = time() . '_' . basename($_FILES['avatar']['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmp, $filePath)) {
                if (!empty($user['avatar']) && file_exists($uploadDir . $user['avatar'])) {
                    unlink($uploadDir . $user['avatar']);
                }

                $user['avatar'] = $fileName;
            }
        }

        $user['name'] = $name;
        $user['email'] = $email;

        User::update($id, $user);

        Session::set('msg_update' , "user $name updated");
        $this->redirect("/dashboard");
    }
}
