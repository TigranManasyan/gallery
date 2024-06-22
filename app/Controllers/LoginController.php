<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
class LoginController extends Controller  {
    public function index() {
        $this->render('login', ['title' => 'Login']);
    }

    public function login() {
        $user = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $logged_user = $user->custom_query("SELECT id,name, email, password FROM users WHERE email = '{$email}'")[0];
        if(password_verify($password,$logged_user['password'])) {
            $_SESSION['user'] = $logged_user;
            header("location:http://gallery.loc/profile");
        } else {
            echo "Oh, no, incorrect login or password";
        }
        dd($logged_user);
    }

    public function logout() {
        session_destroy();
        header("location:http://gallery.loc/");
    }
}