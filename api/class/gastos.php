<?php
class Gastos{
    public $conn;
    public $table = "Gastos";
    public $GastoID;
    public $UsuarioID;
    public $Fecha;
    public $Cantidad;
    public $Descripcion;
    public $CategoriaID;
    public $Sum;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(){
            $query = 'SELECT G.*, C.NombreCategoria  FROM '. $this->table .' AS  G INNER JOIN CategoriasGastos as C ON G.CategoriaID = C.CategoriaID
            WHERE UsuarioID = ' . $this->UsuarioID;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
    }

    public function getByCategory(){
        $query = 'SELECT G.*, C.NombreCategoria  FROM '. $this->table .' AS  G INNER JOIN CategoriasGastos as C ON G.CategoriaID = C.CategoriaID
        WHERE UsuarioID = ' . $this->UsuarioID . ' AND G.CategoriaID = ' . $this->CategoriaID;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
}

    public function post(){
        $query = "INSERT INTO " . $this->table . " SET UsuarioID=:UsuarioID, Fecha=:Fecha, Cantidad=:Cantidad, Descripcion=:Descripcion, CategoriaID=:CategoriaID";
    
        $stmt = $this ->conn->prepare($query);
    
        $this->UsuarioID = htmlspecialchars(strip_tags($this->UsuarioID));
        $this->Fecha = htmlspecialchars(strip_tags($this->Fecha));
        $this->Cantidad = htmlspecialchars(strip_tags($this->Cantidad));
        $this->Descripcion = htmlspecialchars(strip_tags($this->Descripcion));
        $this->CategoriaID = htmlspecialchars(strip_tags($this->CategoriaID));

        $stmt->bindParam(":UsuarioID", $this->UsuarioID);
        $stmt->bindParam(":Fecha", $this->Fecha);
        $stmt->bindParam(":Cantidad", $this->Cantidad);
        $stmt->bindParam(":Descripcion", $this->Descripcion);
        $stmt->bindParam(":CategoriaID", $this->CategoriaID);

        if($stmt->execute()){
            return true;
        }
            return false;
    }

    public function put(){
        $query = "UPDATE " . $this->table . " SET UsuarioID=:UsuarioID, Fecha=:Fecha, Cantidad=:Cantidad, Descripcion=:Descripcion, CategoriaID=:CategoriaID WHERE GastoID=:GastoID";
    
        $stmt = $this ->conn->prepare($query);

        $this->GastoID = htmlspecialchars(strip_tags($this->GastoID));
        $this->UsuarioID = htmlspecialchars(strip_tags($this->UsuarioID));
        $this->Fecha = htmlspecialchars(strip_tags($this->Fecha));
        $this->Cantidad = htmlspecialchars(strip_tags($this->Cantidad));
        $this->Descripcion = htmlspecialchars(strip_tags($this->Descripcion));
        $this->CategoriaID = htmlspecialchars(strip_tags($this->CategoriaID));

        $stmt->bindParam(":GastoID", $this->GastoID);
        $stmt->bindParam(":UsuarioID", $this->UsuarioID);
        $stmt->bindParam(":Fecha", $this->Fecha);
        $stmt->bindParam(":Cantidad", $this->Cantidad);
        $stmt->bindParam(":Descripcion", $this->Descripcion);
        $stmt->bindParam(":CategoriaID", $this->CategoriaID);

        if($stmt->execute()){
            return true;
        }
            return false;
    }

    public function sum(){
        $query = 'SELECT SUM(Cantidad) AS Sum FROM '. $this->table .' WHERE UsuarioID = ' . $this->UsuarioID;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete(){
        $query = 'DELETE FROM '. $this->table .' WHERE GastoID=:GastoID';
        $stmt = $this->conn->prepare($query);
        $this->GastoID = htmlspecialchars(strip_tags($this->GastoID));
        $stmt->bindParam(":GastoID", $this->GastoID);
        $stmt->execute();
        return $stmt;
    }
}