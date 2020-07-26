<?php

namespace KorShop;

class Errors
{
    function preg_matchx($regexp, $content, &$result)
    {
        $res = preg_match($regexp, $content, $result);
        if (!$res) {
            echo '<div style="color:red">Ошибка preg_match - "' . htmlspecialchars($regexp) . '"</div>';
        }
        return $res;
    }

    function preg_matchx_all($regexp, $content, &$result)
    {
        $res = preg_match_all($regexp, $content, $result);
        if (!$res) {
            echo '<div style="color:red">Ошибка preg_match_all - "' . htmlspecialchars($regexp) . '"</div>';
        }
        return $res;
    }
}