<?php


namespace KorShop;


class LoadingProducts
{
    public function getProducts()
    {
        $bd = mysqli_connect("localhost", "root", "root", 'korshop');
        $sql = 'SELECT id, title, price, images, url, endsDate, description FROM product';
        $result = mysqli_query($bd, $sql);
        while ($row = mysqli_fetch_array($result)) {
            print("Название товара: " . $row['title'] . "; Цена товара: " . $row['price'] . "; Срок годности: " . $row['endsDate'] . "; Страница товара: " . $row['url'] . "<br>");
        }
        return $row;
    }
}