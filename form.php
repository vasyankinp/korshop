<?php
include 'index.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Parser</title>
</head>
<body>

<div class="container-fluid">
    <h3></h3>
    <form action="" class="form-inline korshop-form" method="post">
        <div class="form-group">
            <label><a href="<?= $url ?>" target="_blank">Url</a></label>
            <input type="text" class="form-control" name="url" value="<?= $url ?>" style="width: 400px;">
        </div>

        <div class="form-group">
            <label for="">Товар</label>
            <select id='select' class="form-control">
                <option value="https://korshop.ru/catalog/ris_lapsha/ris_i_produkty_iz_nego/">РИС</option>
                <option value="https://korshop.ru/catalog/ris_lapsha/lapsha/">Лапша</option>
                <option value="https://korshop.ru/catalog/sousy_pasty_uksus_/">Соусы, пасты, уксус</option>
                <option value="https://korshop.ru/catalog/sladosti_sneki/">Сладости, снэки</option>
                <option value="https://korshop.ru/catalog/napitki_chay_kofe_zhenshen/">Чай, кофе</option>
            </select>
            </select>
        </div>

        <div class="form-group">
            <label>Показать как:</label>
            <?php
            $showAs = [
                'table' => 'таблица',
                'print_r' => 'массив'
            ];
            ?>
            <select name="showAs" class="form-control">
                <?php
                foreach ($showAs as $k => $v) {
                    $add = '';
                    if ($_POST['showAs'] == $k) {
                        $add = 'selected';
                    }
                    echo '<option ' . $add . ' value="' . $k . '">' . $v . '</option>';
                }
                ?>
            </select>
        </div>
        &nbsp;
        <div class="form-group">
            <label for="">кол-во</label>

            <input type="text" class="form-control" name="maxPage" value="<?= $resultPost->Post('maxPage', 1) ?>"
                   style="width: 50px;">
        </div>
        <div class="checkbox">
            <lavel><input type="checkbox" name="loadPars" value="1">Спарсить</lavel>
        </div>
        <button class="btn btn-default btn-success">выполнить</button>
        <button class="btn btn-default btn-info" formaction="result.php">Проверить БД</button>
    </form>

    <hr/>

    <?php

    if ($_POST['url']) {
        $korShop = new KorShop\Korshop;
        $data = $korShop->parserKorShopAll($_POST['url'], $fromPage = 1, $_POST['maxPage']);

        if ($_POST['showAs'] == 'print_r') {
            echo '<pre>';
            print_r($data);
            echo '<pre/>';
        }
        if ($_POST['showAs'] == 'table') {
            ?>
            <table class="table table-condensed table-bordered table-hover" style="width: auto">
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>О товаре</th>
                    <th>Срок годности</th>
                    <th>картинка</th>
                    <th>URL тов.</th>
                </tr>
                <?php
                foreach ($data as $k => $row) {
                    ?>
                    <tr>
                        <td><a href="<?= $row['url'] ?>" target="_blank"><?= $row['title'] ?></a></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['endsDate'] ?></td>
                        <td><img src="<?= $row['images'] ?>" alt=""></td>
                        <td><?= $row['url'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
//    echo '<pre>'; print_r($data); echo '<pre/>';
        }
    }

    use KorShop\Database;

    //запись в бд с проверкой чекбокса...
    if ($_POST['loadPars'] == 1) {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $images = $_POST['images'];
        $urlKor = $_POST['url'];
        $endsDate = $_POST['endsDate'];
        $description = $_POST['description'];
        $bd = new DataBase("localhost", "root", "root", 'korshop');
        foreach ($data as $store) {
            $bd->query("INSERT INTO `product`(`title`, `price`, `images`, `url`, `endsDate`, `description`) VALUES ('{$store['title']}', '{$store['price']}', '{$store['images']}', '{$store['url']}', '{$store['endsDate']}', '{$store['description']}');");
        }
        $result = mysqli_query($bd);

        if ($result == false) {
            print("Произошла ошибка при выполнении запроса");
        }
    }

    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $("#select").change(function (e) {
        $("input[name='url']").val(e.target.value);
    });
</script>

</body>
</html>
