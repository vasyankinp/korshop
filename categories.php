<?php

namespace KorShop;

$urlCategories = 'https://korshop.ru/catalog/';

$result = new LoadCategories();
$content = $result->parserCategories($urlCategories);
//print_r($content);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <div>
        <button class="btn btn-default btn-success" formaction="/form"><--назад</button>
        <table class="table table-condensed table-bordered table-hover" style="width: auto">
            <tr>
                <th>Товар</th>
                <th>URL тов.</th>
            </tr>
            <?php
            foreach ($content as $k => $row) {
                ?>
                <tr>
                    <td><a href="<?= $row['uri'] ?>" target="_blank"><?= $row['title'] ?></a></td>
                    <td><?= $row['uri'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
if (isset($_POST['load'])) {
    $title = $_POST['title'];
    $urlKor = $_POST['uri'];
    $bd = new DataBase("localhost", "root", "root", 'korshop');
    foreach ($content as $store) {
        $bd->query("INSERT INTO `categories`(`title`, `uri`) VALUES ('{$store['title']}','{$store['uri']}');");
    }
    $result = mysqli_query($bd);
    if ($result == false) {
        print("Произошла ошибка при выполнении запроса");
    }
}
?>
        <button class="btn btn-default btn-success" name="load">спарсить</button>
    </div>
</form>
</body>
</html>

