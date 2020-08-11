<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Записи в БД</title>
</head>
<body>
<form method="post">
    <button formaction="/form" class="btn btn-default btn-success"><-- Назад</button>
</form>
</body>
</html>
<?php

use KorShop\LoadingProducts;

$result = new LoadingProducts();
$products = $result->getProducts($host, $username, $password, $dbname);
//echo $products;

?>

