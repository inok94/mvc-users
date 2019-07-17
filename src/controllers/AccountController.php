<?php


namespace App\src\controllers;


use App\src\core\Controller;

use App\src\models\User;

class AccountController extends Controller
{
    public function loginAction() {
        $this->view->render('Login page');
        if (isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            $result = $user->loginUser($email, $password);
        }
    }
    public function registerAction() {
        $this->view->render('Registe page');
        if (isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['confirmpassword'];

            $user = new User();
            $result = $user->createUser($username, $email, $password, $cpassword);
            echo $result;
        }

    }
}