<?php


namespace KorShop\Service;


use KorShop\DataBase;
use KorShop\HttpRequest;
use KorShop\KorShop;
use KorShop\LoadCategories;
use KorShop\Repository\CategoriesRepository;

class CategoriesService
{
    private $url = 'https://korshop.ru/catalog/';
    /**
     * @var HttpRequest
     */
    private $httpRequest;
    /**
     * @var CategoriesRepository
     */
    private $repository;

    public function __construct()
    {
        $bd = new DataBase(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']
        );

        $this->repository = new CategoriesRepository($bd);
    }

    public function updateCategories()
    {
        $result = new LoadCategories();
        $content = $result->parserCategories($this->url);

        if (!empty($content)) {
            $this->repository->removeAllCategories();

            foreach ($content as $store) {
                $this->repository->saveCategory($store);
            }
        }
    }

    public function getCategories()
    {
        return $this->repository->getAllCategories();
    }
}