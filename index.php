<?php
//require 'vendor/autoload.php';
//
//use KorShop\HttpRequest;
//
//$resultPost = new HttpRequest();
//
//$url = 'https://korshop.ru/catalog/ris_lapsha/ris_i_produkty_iz_nego/';
//$url = $_POST['url'] ?: $url;

require 'class/Routing/Route.php';


route('/form', function () {
include "form.php";
});
route('/result', function () {
    include "result.php";
});

$action = $_SERVER['REQUEST_URI'];
dispatch($action);


//$route = $_GET['route'];
//
//switch ($route) {
//    case 'form':
//        require 'form.php';
//        break;
//    case 'result':
//        require 'result.php';
//        break;
//}
