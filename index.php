<?php
require 'vendor/autoload.php';

use KorShop\HttpRequest;

$resultPost = new HttpRequest();


$url = 'https://korshop.ru/catalog/ris_lapsha/ris_i_produkty_iz_nego/';
$url = $_POST['url'] ?: $url;
