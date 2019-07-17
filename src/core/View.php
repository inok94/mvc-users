<?php

namespace App\src\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        $path =  __DIR__. '/../views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            if (file_exists($path)) {
                require $path;
            }
            $content = ob_get_clean();
            require __DIR__. '/../views/layouts/' . $this->layout . '.php';
        }
    }

    public function redirect($url)
    {
        header('location: ' . $url);
        exit;
    }

    /**
     * @param $code
     * @return object
     */
    public static function errorCode($code): object
    {
        http_response_code($code);
        $path = 'App/src/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

}