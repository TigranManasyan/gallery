<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
class RegisterController extends Controller {
    public function index() {
        $this->render('register', ['title' => 'Register']);
    }
    public function register() {
        $user = new User();
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if($user->user_exists($data['email'])) {
            die('User Exists');
        }
        $user
            ->create(
                ['name', 'email', 'password'],
                [$data['name'], $data['email'],
                    $data['password']], "users");
        header("location:http://gallery.loc/");
    }
}