<?php


namespace KorShop\Controller;


use KorShop\HttpRequest;
use KorShop\Service\ProductService;

class ProductController
{
    public $id;


    public function parse()
    {
        $httpRequest = new HttpRequest();
        $id = $httpRequest->post('category_id');
        $productService = new ProductService();
        $productService->updateProductsOneCategory($id);
        header('Location: /product/list/' . $id);
    }
    public function parseAll()
    {
        $productService = new ProductService();
        $productService->getAllProductsCategories();
        header('Location: /product/listAll/');
    }

    public function list($id)
    {
        $productService = new ProductService();
        $products = $productService->getProducts($id);
        include PATH . "/templates/productList.php";
    }

    public function listAll()
    {
        $productService = new ProductService();
        $products = $productService->getAllProducts();
        include PATH . "/templates/productList.php";
    }
}