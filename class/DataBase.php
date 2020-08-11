<?php

namespace KorShop;


class DataBase
{
    private $connection;
    public $host;
    public $username;
    public $password;
    public $dbname;


    function __construct($host, $username, $password, $dbname)
    {
        $this->connection = mysqli_connect($host, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        mysqli_query($this->connection, $sql);
    }

    public function fetch($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        $rows = [];
        foreach ($result as $row) {
            $rows[] = $row;
        }
        return $rows;
    }
}