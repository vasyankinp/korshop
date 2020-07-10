<?php
include 'errors.php';
include 'class/SetCashLoad.php';
include 'class/GetCashLoad.php';
include 'class/Guzzle.php';
include 'class/POSTS.php';
include 'class/KorShop.php';
require 'vendor/autoload.php';


$url = 'https://korshop.ru/catalog/ris_lapsha/ris_i_produkty_iz_nego/';
$url = $_POST['url'] ?: $url;
