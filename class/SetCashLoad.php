<?php

namespace KorShop;

class SetCashLoad
{
    public function setCache($content, $cacheId) // записываем файл
    {
        if ($content == '') {
            return;
        }
        $fileName = 'cashKorShop/' . md5($cacheId);

        if (!file_exists('cashKorShop')) {
            mkdir('cashKorShop');
        }
        $f = fopen($fileName, 'w+');
        fwrite($f, $content);
        fclose($f);
    }
}