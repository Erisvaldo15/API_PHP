<?php

namespace app\core;

class Request {

    public static function extract() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    
}