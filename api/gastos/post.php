<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

include_once('../config/conection.php');
include_once('../class/gastos.php');

$conn = new Conection();
$db = $conn->getConection();

$gastos = new Gastos($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->UsuarioID) && !empty($data->Fecha) && !empty($data->Cantidad) && !empty($data->Descripcion) && !empty($data->CategoriaID)){
    $gastos->UsuarioID = $data->UsuarioID;
    $gastos->Fecha = $data->Fecha;
    $gastos->Cantidad = $data->Cantidad;
    $gastos->Descripcion = $data->Descripcion;
    $gastos->CategoriaID = $data->CategoriaID;

    if($gastos->post()){
        http_response_code(201);
        echo json_encode(array("message"=>"El gasto ha sido creado"));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message"=>"No se puede crear el gasto"));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"No se puede crear el gasto, los datos estan incompletos"));
}