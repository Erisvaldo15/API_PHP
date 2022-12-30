<?php

namespace app\routes;

class Routes {

    public static function extract() {
       
        return [

            "get" => [
                "/api/songs" => "SongController:index",
                "/api/songs/[0-9]+" => "SongController:show",
            ]

        ];

    }

    private static function staticRoute($actualUri, $routes) {

        if(array_key_exists($actualUri, $routes)) {
            return $routes[$actualUri];
        }

        return null;
    }

    private static function dynamicRoute($actualUri, $routes) {

       foreach ($routes as $uri => $controllerAndMethod) {

            $regex = str_replace('/', '\/', ltrim($uri, '/'));

            if($uri !== '/' && preg_match("/^$regex$/", ltrim($actualUri, '/'))) {
                $routerFound = $controllerAndMethod;
                break;
            } 
            
            $routerFound = null;
        }

        return $routerFound;
    }


    public static function filter($actualUri, $routes) {

        $router = self::staticRoute($actualUri, $routes);

        if($router) {
            return $router;
        }

        $routerDynamic = self::dynamicRoute($actualUri, $routes);

        if($routerDynamic) {
            return $routerDynamic;
        }

        if(!array_key_exists($actualUri, $routes)) {
            http_response_code(404);
            die;
        } 

    }

}