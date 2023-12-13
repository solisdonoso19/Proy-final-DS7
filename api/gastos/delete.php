<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");


include_once ('../config/conection.php');
include_once('../class/gastos.php');

$conn = new Conection();
$db = $conn->getConection();

$gastos = new Gastos($db);
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->GastoID)){
    $gastos->GastoID = $data->GastoID;
    try {
        //code...
        $stmt =  $gastos->delete();
    } catch (\Throwable $th) {
       echo $th;
    }
   
    if ($stmt) {
        http_response_code(200);
        echo (1);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Gasto no encontrado."));
}
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"Los datos estan incompletos"));
}
