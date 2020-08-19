<?php
include 'header.php';
?>

<div class="container-fluid">
    <h3></h3>
    <form action="/product/parse" class="form-inline korshop-form" method="post">

        <div class="form-group">
            <label for="">Категории</label>
            <select id="select" class="form-control" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="submit" value="Спарсить">
    </form>
</div>

<?php
include 'footer.php';
?>

