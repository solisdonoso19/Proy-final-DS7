<?php
class Gastos{
    public $GastoID;
    public $UsuarioID;
    public $Fecha;
    public $Cantidad;
    public $Descripcion;
    public $CategoriaID;
    public $NombreCategoria;

    public function get($id){
        $apiUrl = 'http://localhost/semestral/api/gastos/get.php';
        $postData = array(
            'UsuarioID'   => $id,
        );
        
        $jsonData = json_encode($postData);
        $ch = curl_init($apiUrl);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        
        if ($response === false) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
        } else {
            return json_decode($response, true);
        }
        
        // Cierra la sesión cURL
        curl_close($ch);
    }

    public function sum($id){
        $apiUrl = 'http://localhost/semestral/api/gastos/sum.php';
        $postData = array(
            'UsuarioID'   => $id,
        );
        
        $jsonData = json_encode($postData);
        $ch = curl_init($apiUrl);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        
        if ($response === false) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
        } else {
            return json_decode($response, true);
        }
        
        // Cierra la sesión cURL
        curl_close($ch);
    }
}