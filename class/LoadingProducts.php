<?php


namespace KorShop;


class LoadingProducts
{
    public $connection;
    public $host;
    public $user;
    public $password;
    public $database;

    public function getProducts($host, $username, $password, $dbname)
    {
        $this->connection = mysqli_connect($host, $username, $password, $dbname);
        $sql = 'SELECT id, title, price, images, url, endsDate, description FROM product';
        $result = mysqli_query($this->connection, $sql);
        while ($row = mysqli_fetch_array($result)) {
            print("Название товара: " . $row['title'] . "; Цена товара: " . $row['price'] . "; Срок годности: " . $row['endsDate'] . "; Страница товара: " . $row['url'] . "<br>");
        }
        return $row;
    }
}