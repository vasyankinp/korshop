<?php


namespace KorShop\Repository;


use KorShop\DataBase;

class CategoriesRepository
{
    /**
     * @var DataBase
     */
    private $dataBase;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function removeAllCategories()
    {
        $this->dataBase->query("DELETE FROM categories");
    }
    public function removeCategoryStatus($id)
    {
        $this->dataBase->query("DELETE FROM `categories` (`status`) VALUES('') WHERE  id = '$id'");
    }

    public function saveCategoryStatus($status, $id)
    {
        $this->dataBase->query("UPDATE categories SET status = '$status' WHERE id = '$id'");
    }
    public function updateAllStatus($status)
    {
        $this->dataBase->query("UPDATE categories SET status = '$status'");
    }

    public function saveCategory(array $store)
    {
        $this->dataBase->query("INSERT INTO `categories`(`title`, `uri` , `status`) VALUES ('{$store['title']}','{$store['uri']}', 0);");
    }

    public function getAllCategories()
    {
        return $this->dataBase->fetch("SELECT * FROM categories");
    }

    public function getCategory($id)
    {
        return $this->dataBase->fetch("SELECT * FROM categories WHERE id = $id");
    }
}