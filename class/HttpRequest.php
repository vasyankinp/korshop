<?php

namespace KorShop;


class HttpRequest
{
    public function post($key, $default = '')
    {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        } else {
            return $default;
        }
    }
}
