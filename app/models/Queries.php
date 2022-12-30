<?php

namespace app\models;

class Queries extends Model {

    public function select($table, $fieldsAndAlias = ['table.field' => 'Name']) {

        $selectFields = "";

        foreach ($fieldsAndAlias as $field => $alias) {
            
            if(end(array_keys($fieldsAndAlias)) === $field) {
                $selectFields .= "{$field} as '{$alias}' ";
                break;
            }

            $selectFields .= "{$field} as '{$alias}', ";
        }

        return "select {$selectFields} from {$table}";
    }

    public function join($condition, $join = 'users', $type = 'inner',) {
        return "{$type} join {$join} on {$condition}";
    }

    public function where($table, $field, $condition, $value) {
        return "where {$table}.{$field} {$condition} {$value}";
    }

    public function get($query) {

        try {
            return $this->execute($query);
        } 
        
        catch (\Throwable) {
            http_response_code(500);
            die;
        }
       
    }

}
