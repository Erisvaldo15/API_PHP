<?php

namespace app\core;

class Method {

    public function extract($controllerAndMethod, $controllerInstance) {

        $methodController = explode(':', $controllerAndMethod)[1];
        
        if(!method_exists($controllerInstance, $methodController)) {
            http_response_code(500);
            die;
        }

        return $methodController;
    }

}