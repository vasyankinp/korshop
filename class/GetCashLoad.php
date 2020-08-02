<?php

namespace KorShop;

class GetCashLoad
{
    public function getCache($cacheId, $cashExpired = true, &$fileName = '') //кэшируем файл
    {
        if (!$cashExpired) {
            return;
        }
        $fileName = 'cashKorShop/' . md5($cacheId);
        if (file_exists($fileName)) {
            return false;
        }
        $time = time() - filemtime($fileName);
        if ($time > $cashExpired) {
            return false;
        }
        return file_get_contents($fileName);
    }
}