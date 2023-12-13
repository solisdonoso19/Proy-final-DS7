<?php
class User{
    public $conn;
    public $table = "Usuarios";
    public $UsuarioID;
    public $Nombre;
    public $Contrasena;
    public $CorreoElectronico;
    public $PresupuestoMensual;

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

    public function post(){
        $query = "INSERT INTO " . $this->table . " SET Nombre=:Nombre, Contrasena=:Contrasena, CorreoElectronico=:CorreoElectronico, PresupuestoMensual=:PresupuestoMensual";
    
        $stmt = $this ->conn->prepare($query);
    
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Contrasena = htmlspecialchars(strip_tags($this->Contrasena));
        $this->CorreoElectronico = htmlspecialchars(strip_tags($this->CorreoElectronico));
        $this->PresupuestoMensual = htmlspecialchars(strip_tags($this->PresupuestoMensual));
    
        $stmt->bindParam(":Nombre", $this->Nombre);
        $stmt->bindParam(":Contrasena", $this->Contrasena);
        $stmt->bindParam(":CorreoElectronico", $this->CorreoElectronico);
        $stmt->bindParam(":PresupuestoMensual", $this->PresupuestoMensual);

        if($stmt->execute()){
            return true;
        }
            return false;
    }

    public function auth(){

        $query = 'SELECT * FROM ' . $this->table . ' WHERE CorreoElectronico = "' . $this->CorreoElectronico .'"';
        $stmt = $this ->conn->prepare($query);
        if($stmt->execute()){
            return $stmt;
        }
        return false;
    }
}