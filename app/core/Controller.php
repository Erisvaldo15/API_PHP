<?php

namespace app\core;

class Controller {

    private string $namespace = "app\\controllers\\";

    public function extract($controllerAndMethod) {

        $controllerName = explode(':', $controllerAndMethod)[0];
        $namespaceController = $this->namespace.$controllerName;
    
        if(!class_exists($namespaceController)) {
            dd('Controller does not exist');
        }

        return $namespaceController;   
    }


}