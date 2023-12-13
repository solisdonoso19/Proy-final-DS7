<?php
class Conection
{
    private $host = 'localhost';
    private $name = 'semestral';
    private $user = 'root';
    private $pass = '';
    public  $conn;
    public function getConection()
    {
        $this->conn = null;
        try {
            $this->conn =
                new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name, $this->user, $this->pass);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Error en conectar la base de datos";
        }
        return $this->conn;
    }
}