<?php

namespace app\models;

use app\database\Connection;
use PDO;

abstract class Model {

    private $connection;

    public function __construct()
    {
        $this->connection = $this->initConnection();
    }

    private function initConnection() {
        return Connection::connect();
    }

    protected function execute(string $query) {
        $execute = $this->connection->prepare($query);
        $execute->execute();
        return $execute->fetchAll(PDO::FETCH_ASSOC);
    }

}