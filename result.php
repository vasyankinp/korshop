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
    <button formaction="form.php" class="btn btn-default btn-success"><-- Назад</button>
</form>
</body>
</html>
<?php

$bd = mysqli_connect("localhost", "root", "root", 'korshop');
$sql = 'SELECT id, title, price, images, url, endsDate, description FROM product';
$result = mysqli_query($bd, $sql);
while ($row = mysqli_fetch_array($result)) {
    print("Название товара: " . $row['title'] . "; Цена товара: " . $row['price'] ."; Срок годности: " . $row['endsDate'] ."; Страница товара: " . $row['url'] .  "<br>");
}
?>

