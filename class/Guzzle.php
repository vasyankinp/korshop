<?php
namespace Client;
use GuzzleHttp\Client as Client;
use GetCachLoad\GetCacheLoad;
use SetCachLoad\SetCashLoad;
class Guzzle {

    function guzzleLoad($url, $cash = 0)
    {
        $this->fromCash = false;
        $cacheId = $url;
        $getCash = new GetCacheLoad();
        $setCash = new SetCashLoad();
        if ($content = $getCash->getCache($cacheId, $cash)) {
            $this->fromCash = true;
            return $content;
        }
        $client = new Client([
            'base_uri' => $url,
            'timeout' => 2.0
        ]);
        $response = $client->request('GET');

        $content = $response->getBody()->getContents();

        $setCash->setCache($content, $cacheId);
        return $content;
    }
}