<?php

namespace App\src\core;

use App\src\core\View;

abstract class Controller
{
    public $route;
    public $view;

    /**
     * Controller constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'App\src\models\\' . ucfirst($name);
        try {
            if (!class_exists($path)) {
                throw new \Exception("Model not found");
            }
            return new $path;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}