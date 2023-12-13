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

if(!empty($data->UsuarioID) && !empty($data->CategoriaID)){
    $gastos->UsuarioID = $data->UsuarioID;
    $gastos->CategoriaID = $data->CategoriaID;

    $stmt =  $gastos->getByCategory();
    $num  = $stmt->rowCount();

    if ($num > 0) {
        $gastos_arr = array();
        $gastos_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $item = array(
                "UsuarioID" => $UsuarioID,
                "GastoID" => $GastoID,
                "Fecha" => $Fecha,
                "Cantidad" => $Cantidad,
                "Descripcion" => $Descripcion,
                "CategoriaID" => $CategoriaID,
                "NombreCategoria" => $NombreCategoria
            );
            array_push($gastos_arr["records"], $item);
        }
        http_response_code(200);
        echo json_encode($gastos_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "No se encontraron gastos."));
}
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"Los datos estan incompletos"));
}
