<?php

//ini_set('display_errors', 1);

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

define('PATH', __DIR__);


use KorShop\Routes;

$router = new Routes();
$router->get();
