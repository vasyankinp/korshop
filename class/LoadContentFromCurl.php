<?php


namespace KorShop;

class LoadContentFromCurl implements LoadCoupons
{
    function CurlAndGuzzleLoad($url, $cash = 0)
    {
        $get = new GetCashLoad();
        $set = new SetCashLoad();
        $cacheId = $url;
        if ($content = $get->getCache($cacheId, $cash)) {
            return $content;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $content = curl_exec($ch);
        curl_close($ch);
        $set->setCache($content, $cacheId);
        return $content;
    }

}