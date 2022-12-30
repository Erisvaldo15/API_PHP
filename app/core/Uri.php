<?php

namespace app\core;

class Uri {

    public static function extract(string $type = 'path') {
        return parse_url($_SERVER['REQUEST_URI'])[$type];
    }

}