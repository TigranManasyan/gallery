<?php
namespace App\Routes;

class Router {
    protected $routes = [];

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @param $method
     * @return void
     */
    private function addRoute($route, $controller, $action, $method) {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @return void
     */
    public function get($route, $controller, $action) {
        $this->addRoute($route, $controller, $action, "GET");
    }

    /**
     * @param $route
     * @param $controller
     * @param $action
     * @return void
     */
    public function post($route, $controller, $action) {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch() {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];
//        dd($this->routes["POST"]);
        if(array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];
            $controller = new $controller();
            $controller->$action();
        } else {
            throw new \Exception("No route found for URI: $uri");
        }
    }
}

