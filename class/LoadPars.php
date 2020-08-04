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

    public function startParser($data)
    {
        $this->title = $_POST['title'];
        $this->price = $_POST['price'];
        $this->images = $_POST['images'];
        $this->urlKor = $_POST['url'];
        $this->endsDate = $_POST['endsDate'];
        $this->description = $_POST['description'];
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