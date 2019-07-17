<?php
/**
 * Created by PhpStorm.
 * User: Inok94
 * Date: 7/11/2019
 * Time: 3:34 PM
 */

namespace App\src\controllers;


use App\src\core\Controller;
use App\src\lib\Pagination;

class UserController extends Controller
{
    public function listAction()
    {
        $pagination = new Pagination($this->route, $this->model->usersCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->usersList($this->route),
        ];
        $this->view->render('Users list', $vars);

    }

    public function editAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $dataUri = explode("/", $uri);
        $userIdFromUrl = $dataUri[3];
        $userData = $this->model->getUserDataById((int)$userIdFromUrl);
        $vars = [
            'data' => $userData[0],
        ];
        var_dump($vars);
        $this->view->render('Edit page', $vars);

        if (isset($_POST['username']) && isset($_POST['email'])) {
            $userName = $_POST['username'];
            $email = $_POST['email'];
            try {
                $result = $this->model->editUser($userIdFromUrl, $userName, $email);
                echo $result;

                throw new \Exception("Data don't save.");
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }
    }

    public function deleteAction()
    {
    }

    public function passwordAction()
    {

        $this->view->render('Edit password');
        $uri = $_SERVER['REQUEST_URI'];
        $dataUri = explode("/user=", $uri);
        $userIdFromUrl = $dataUri[1];

        if (isset($_POST['newpassword'])) {
            $password = $_POST['newpassword'];
            $confirmPassword = $_POST['confirmpassword'];
            $result = $this->model->editUserPassword($userIdFromUrl, $password, $confirmPassword);
            //$this->view->redirect("/user/list/1");
            echo $result;
        }
    }
}