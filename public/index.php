<?php

use app\core\MyApp;

require_once '../vendor/autoload.php';

try {

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
    $dotenv->load();

    $app = new MyApp;
    $app->execute();
} 

catch (\Throwable $th) {
    echo "Error: {$th->getMessage()} in line {$th->getLine()} in File {$th->getFile()}";
}