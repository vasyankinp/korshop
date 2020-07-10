<?php


class POSTS
{
    function POST($key, $default = '')
    {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        } else {
            return $default;
        }
    }
}
$resultPost = new POSTS();