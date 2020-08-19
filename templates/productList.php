<?php
include 'header.php';
?>

<div class="container-fluid">
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
        foreach ($products as $k => $row) {
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
</div>

<?php
include 'footer.php';
?>

