<?php

namespace app\core;

use app\interfaces\MyAppInterface;
use app\routes\Routes;

class MyApp implements MyAppInterface {

    public function execute() {

        $routes = Routes::extract();
        $actualUri = Uri::extract();
        $request = Request::extract();

        if(!isset($routes[$request])) {
            http_response_code(400);
            die;
        }

        $controllerAndMethod = Routes::filter($actualUri, $routes[$request]);

        $namespaceController = (new Controller)->extract($controllerAndMethod);
        $controllerInstance = new $namespaceController;

        $method = (new Method)->extract($controllerAndMethod, $controllerInstance);

        $parameter = (new Parameter)->extract($controllerAndMethod, $routes[$request], $actualUri);

        $controllerInstance = $controllerInstance->$method($parameter);
    }
   
}