<?php

namespace app\core;

class Parameter {

    private array $parameter = [];

    private function validate($routerOfController,$actualUri) {

        $actualUri = explode('/', ltrim($actualUri, '/'));
        $routerOfController = explode('/', ltrim($routerOfController, '/'));

        foreach ($routerOfController as $index => $segmentUri) {

            if($segmentUri !== $actualUri[$index]) {
                $this->parameter[$index] = $actualUri[$index];
            }

        }

        return $this->parameter;
    }

    public function extract($controllerAndMethod, $routes, $actualUri) {

        $routerOfController = array_search($controllerAndMethod, $routes);
        $parameter = $this->validate($routerOfController, $actualUri);
        
        return array_values($parameter);
    }

}