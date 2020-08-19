<?php


namespace KorShop\Service;


use KorShop\DataBase;
use KorShop\KorShop;
use KorShop\Repository\CategoriesRepository;
use KorShop\Repository\ProductRepository;

class ProductService
{
    private $productRepository;
    private $categoriesRepository;


    public function __construct()
    {
        $bd = new DataBase(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']
        );
        $this->productRepository = new ProductRepository($bd);
        $this->categoriesRepository = new CategoriesRepository($bd);
    }

    public function updateProduct($id)
    {
        $this->categoriesRepository->getCategory($id);
    }

    public function updateStatus($status, $id)
    {
        $this->categoriesRepository->saveCategoryStatus($status, $id);
    }

    public function updateProductsOneCategory($id)
    {
        $korShop = new KorShop();
        $categories = $this->categoriesRepository->getCategory($id);
        $status = 0;
        $this->updateStatus($status, $id);
        $products = [];
        foreach ($categories as $category) {
            $url = $category['uri'];
            $products = $korShop->parserKorShopAll($url, $fromPage = 1, $maxPage = 1);
            if (!empty($products)) {
                $id = strval($id);
                foreach ($products as &$data) {
                    $data['category_id'] = $id;
                }
                $this->productRepository->removeAllProducts($id);
                foreach ($products as $product) {
                    $this->productRepository->saveProduct($product);
                }
            }
        }
        if (!empty($products)) {
            $status = 1;
            $this->updateStatus($status, $id);
        }
    }

    public function getAllProductsCategories()
    {
        $korShop = new KorShop();
        $categories = $this->categoriesRepository->getAllCategories();
        $status = 0;
        $this->categoriesRepository->updateAllStatus($status);
        foreach ($categories as $category) {
            $url = $category['uri'];
            $id = $category['id'];
            $products = $korShop->parserKorShopAll($url, $fromPage = 1, $maxPage = 1);
            if (!empty($products)) {
                foreach ($products as &$data) {
                    $data['category_id'] = $id;
                }
                $this->productRepository->removeAllProducts($id);
                foreach ($products as $product) {
                    $this->productRepository->saveProduct($product);
                    if (!empty($product)) {
                        $status = 1;
                        $this->updateStatus($status, $id);
                    }
                }
            }
        }
    }




    public function getProducts($id)
    {
        return $this->productRepository->getAllProducts($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProductsCategory();
    }

}