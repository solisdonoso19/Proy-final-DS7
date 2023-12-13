<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

include_once('../config/conection.php');
include_once('../class/user.php');

$conn = new Conection();
$db = $conn->getConection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->Nombre) && !empty($data->Contrasena) && !empty($data->CorreoElectronico) && !empty($data->PresupuestoMensual)){
    $user->Nombre = $data->Nombre;
    $user->Contrasena = $data->Contrasena;
    $user->CorreoElectronico = $data->CorreoElectronico;
    $user->PresupuestoMensual = $data->PresupuestoMensual;
       
    if($user->post()){
        http_response_code(201);
        echo json_encode(array("message"=>"El usuario ha sido creado"));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message"=>"No se puede crear el usuario"));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"No se puede crear el usuario, los datos estan incompletos"));
}