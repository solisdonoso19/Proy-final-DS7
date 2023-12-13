<?php
class Categories{
    public $conn;
    public $table = "CategoriasGastos";
    public $CategoriaID;
    public $NombreCategoria;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(){
        $query = 'SELECT * FROM '. $this->table .'';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}