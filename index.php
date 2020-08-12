<?php

ini_set('display_errors', 1);

require 'vendor/autoload.php';

use KorShop\Routes;

$router = new Routes();
$router->get();


//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
//$dotenv->load();

//$host = $_ENV['DB_HOST'];
//$username = $_ENV['DB_USER'];
//$password = $_ENV['DB_PASSWORD'];
//$dbname = $_ENV['DB_NAME'];
