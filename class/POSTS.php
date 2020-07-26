<?php

namespace KorShop;

class Posts
{
    function Post($key, $default = '')
    {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        } else {
            return $default;
        }
    }
}
