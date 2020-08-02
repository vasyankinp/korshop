<?php

namespace KorShop;


class Routes
{
    public $uri;
    public $array;

    public function get()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $array = array(
            '/form' => 'form.php',
            '/index' => 'form.php',
            '/result' => 'result.php'
        );

        foreach ($array as $key => $value) {
            if ($uri == $key) {
                require $array[$uri];
                break;
            }
        }
        if ($uri != $key) {
            require "error404.php";
        }
    }
}

