<?php

namespace KorShop;

class Routes
{
    public $uri;
    public $array;

    public function get()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (!file_exists(include 'array.php') == TRUE) {
            if (isset($array[$uri])) {
                require $array[$uri];
            } else {
                require 'error404.php';
            }
        }
    }
}
