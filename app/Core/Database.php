<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $host = 'phpmyadmin';
    private $dbname = 'customer_details';
    private $charset = 'utf8mb4';
    private $user = 'root';
    private $pass = '12345';
    public $connect;

    public function getConnection()
    {
        $this->connect = null;
        try {
            $this->connect = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset",
                $this->user,
                $this->pass,
            );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->connect;
    }
}
