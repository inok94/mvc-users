<?php
namespace App\src\controllers;

use \App\src\core\Controller;
class MainController extends Controller
{
    public function indexAction() {
        //$result = $this->model->getNews();
        $vars = [
            'news' => 'asdasd',
        ];
        $this->view->render('Главная страница', $vars);
        //echo "We are in MainController";
    }
}