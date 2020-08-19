<?php


namespace KorShop\Repository;


use KorShop\DataBase;

class ProductRepository
{
    private $dataBase;

    /**
     * ProductRepository constructor.
     * @param DataBase $dataBase
     */
    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function removeAllProducts($id)
    {
        $this->dataBase->query("DELETE FROM product WHERE category_id ='$id'");
    }

    public function saveProduct(array $store)
    {
        $this->dataBase->query("INSERT INTO `product`(`title`, `price`, `images`, `url`, `endsDate`, `description`, `category_id`) VALUES ('{$store['title']}', '{$store['price']}', '{$store['images']}', '{$store['url']}', '{$store['endsDate']}', '{$store['description']}', '{$store['category_id']}');");
    }

    public function getAllProducts($id)
    {
        return $this->dataBase->fetch("SELECT id, title, price, images, url, endsDate, description, category_id FROM product WHERE category_id = '$id'");
    }

    public function getAllProductsCategory()
    {
        return $this->dataBase->fetch("SELECT id, title, price, images, url, endsDate, description, category_id FROM product");
    }
}