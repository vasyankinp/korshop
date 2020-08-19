<?php


namespace KorShop\Controller;


use KorShop\Repository\CategoriesRepository;
use KorShop\Service\CategoriesService;
use KorShop\Service\ProductService;

class ParserController
{
    public function form()
    {
        $categoryService = new CategoriesService();
        $categories = $categoryService->getCategories();
        include PATH . "/templates/parser.php";
    }

    public function parseAll($mode = 'refresh')
    {

    }

    public function categories()
    {
        $catalogService = new CategoriesService();
        $categories = $catalogService->getCategories();
    }
    public function product()
    {
        $productService = new ProductService();
        $products = $productService->getProducts();
    }
}