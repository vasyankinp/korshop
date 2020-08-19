<?php


namespace KorShop\Controller;

use KorShop\HttpRequest;
use KorShop\Service\CategoriesService;

class CategoriesController
{
    public function parse()
    {
//        $httpRequest = new HttpRequest();

//        if ($httpRequest->post('load')) {
//            $title = $httpRequest->post('title');
//            $urlKor = $httpRequest->post('uri');
//        }
        $catalogService = new CategoriesService();
        $catalogService->updateCategories();
    }

    public function list()
    {
        $catalogService = new CategoriesService();
        $categories = $catalogService->getCategories();
        echo '<pre>';
        var_dump($categories);
    }
}