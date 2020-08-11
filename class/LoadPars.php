<?php


namespace KorShop;


class LoadPars
{
    public $title;
    public $price;
    public $images;
    public $urlKor;
    public $endsDate;
    public $description;
    /**
     * @var HttpRequest
     */
    private $httpRequest;

    public function __construct(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function startParser($data)
    {
        $this->title = $this->httpRequest->post('title');
        $this->price = $this->httpRequest->post('price');
        $this->images = $this->httpRequest->post('images');
        $this->urlKor = $this->httpRequest->post('url');
        $this->endsDate = $this->httpRequest->post('endsDate');
        $this->description = $this->httpRequest->post('description');

        $bd = new DataBase("localhost", "root", "root", 'korshop');
        foreach ($data as $store) {
            $bd->query("INSERT INTO `product`(`title`, `price`, `images`, `url`, `endsDate`, `description`) VALUES ('{$store['title']}', '{$store['price']}', '{$store['images']}', '{$store['url']}', '{$store['endsDate']}', '{$store['description']}');");
        }
        $result = mysqli_query($bd);
        if ($result == false) {
            print("Произошла ошибка при выполнении запроса");
        }
    }
}
