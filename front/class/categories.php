<?php
class Categories{
    public $CategoriaID;
    public $NombreCategoria;

    public function get(){
        $apiUrl = 'http://localhost/semestral/api/categories/get.php';
        $response = file_get_contents($apiUrl);
        $data =  json_decode($response, true);
        return $data['records'];
    }
}