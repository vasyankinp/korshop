<?php
include 'errors.php';

function setCache($content, $cacheId) // записываем файл
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

function getCache($cacheId, $cashExpired = true, &$fileName = '') //кэшируем файл
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

function curlLoad($url, $cash = 0)
{
    $cacheId = $url;
    if ($content = getCache($cacheId, $cash)) {
        // если заблочили то добавить этот кодик
//        1 - ая часть
//        if (!strpos($content, 'Location: .... blocked')) {
//            return $content;
//        }

        return $content;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//    curl_setopt($ch, CURLOPT_HEADER,1);
    //    2 - ая часть
//    $headers = array(
//            хедер страницы
//    );
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $content = curl_exec($ch);
    curl_close($ch);
//    3 - ая часть
//    $rx = '~^(HTTP.*?)~is';
//    preg_match($rx, $content, $a);
//    $header = $a[0];
//    $content = str_replace($header, '', $content);
//    if (strpos($header, 'Location: ... blocked')) {
//        echo '<h3>Заблокировали на сайте</h3>';
    //    echo '<pre>' .$header. '</pre>';
    //    exit;
//    }
//    sleep(rand(2, 5));

    setCache($content, $cacheId);
    return $content;
}

function POST($key, $default = '')
{
    if (array_key_exists($key, $_POST)) {
        return $_POST[$key];
    } else {
        return $default;
    }
}


class Korshop
{
    function parserKorShopAll($url, $fromPage = 1, $maxPage = false)
    {
        $dataAll = [];
        $page = $fromPage;
        while (true) {
            if ($page == 1) {
                $urlCurrent = $url;
            } else {
                if (strpos($url, '?')) {
                    $urlCurrent = str_replace('?', '?PAGEN 2=' . $page . '&', $url);
                } else {
                    $urlCurrent = $url . '?PAGEN 2=' . $page;
                }
            }
            $data = $this->parserKorShopPage($url);
            if (!count($data)) {
                break;
            }
            $dataAll = array_merge($dataAll, $data);
            if ($maxPage && $page == $maxPage) {
                break;
            }
            $page++;
        }
        return $dataAll;
    }

    function parserKorShopPage($url)
    {


        $content = curlLoad($url, $cash = 3600);

        preg_matchx('~<div class="showcase clearfix" id="showcaseview">(.*?)<div class="ajaxpages showcase">~is', $content, $a);
        $innerContent = $a[0];

        $rows = preg_split('~<div class="js-element~', $innerContent);
        array_shift($rows);

        preg_matchx_all('~<div class="js-element.*?</i>В избранное</a></div></div></div></div>~is', $innerContent, $rows);

//echo htmlspecialchars($content);
//exit;
        $data = [];
        foreach ($rows[0] as $rowContent) {
            $row = [];
            preg_match('~<div class="name"><a href=".+" title=".+">(.*?)</a></div>\s*<div class="sku">~is', $rowContent, $a);
            $row['title'] = $a[1];
            preg_match('~<span class="price gen price_pdv_BASE">(.*?).</span>~is', $rowContent, $a);
            $row['price'] = $a[1];
            preg_match('~<img class="js_picture_glass" data-src=".+" src="(.*?)" alt=".+" title=".+" /><div class="glass_lupa">~is', $rowContent, $a);
            $row['images'] = 'https://korshop.ru' . $a[1];
            preg_match('~<div class="name"><a href="(.*?)"~is', $rowContent, $a);
            $row['url'] = 'https://korshop.ru' . $a[1];
// берем данные из карточки
            $cardContent = curlLoad($row['url'], 86400);

            if (preg_match('~<div class="exp_date">\s*<b>Срок годности:</b>\s*(.*?)\s*</div>\s*<div class="previewtext" itemprop="description">~is', $cardContent, $a)) {
                $endsDate = $a[1];
                if ($date = DateTime::createFromFormat('d.m.Y', $endsDate)) {
                    $transformDate = $date->format('Y-m-d');
                    $row['endsDate'] = $transformDate;
                } else {
                    $row['endsDate'] = '-';
                }
            } else {
                $row['endsDate'] = '-';
            }
            if (preg_match('~<div class="previewtext" itemprop="description"><p>\s*(.*?)\s*</p>~is', $cardContent, $a)) {
                $row['description'] = $a[1];
            } else {
                $row['description'] = 'Описание отсутствует';
            }
            $data[] = $row;
        }
        return $data;
    }
}


$url = 'https://korshop.ru/catalog/ris_lapsha/ris_i_produkty_iz_nego/';
$url = $_POST['url'] ?: $url;
//$data = parserKorShopAll($url, $fromPage = 1, $maxPage = 2);
//echo '<pre>';
//var_dump(count($data));
//print_r($data);
//echo '<pre/>';
//echo '<hr />';