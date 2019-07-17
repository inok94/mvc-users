<?php

namespace App\src\core;

use App\src\core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require __DIR__.'/../conf/routes.php';
        foreach ($arr as $key => $val) {
            $this->addRoutes($key, $val);
        }
    }

    /**
     * @param string $route
     * @param array $params
     */
    public function addRoutes(string $route, array $params)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        //Prepare route string to reg.
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    /**
     * Find match with route path and request url.
     *
     * @return bool
     */
    public function match():bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Run controller and method if this conditions equal path in routs.
     */
    public function run()
    {
        //TODO REFACTOR. Add Try/Catch.
        if ($this->match()) {
            $path = 'App\src\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}