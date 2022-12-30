<?php

namespace app\database;

use PDO;

class Connection {

    public static function connect() {

        try {
            return new PDO("mysql:host={$_ENV['DATABASE_HOST']}; dbname={$_ENV['DATABASE_NAME']}", 
            $_ENV['DATABASE_ROOT'], $_ENV['DATABASE_PASSWORD']);
        } 
        
        catch (\Throwable) {
            http_response_code(500);
            die;
        }

    }

}