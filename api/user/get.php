<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once ('../config/conection.php');
include_once('../class/user.php');

$conn = new Conection();
$db = $conn->getConection();

$user = new User($db);

$stmt =  $user->get();
$num  = $stmt->rowCount();

if ($num > 0) {
    $user_arr = array();
    $user_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $item = array(
            "UsuarioID" => $UsuarioID,
            "Nombre" => $Nombre,
            "Contrasena" => $Contrasena,
            "CorreoElectronico" => $CorreoElectronico,
            "PresupuestoMensual" => $PresupuestoMensual,
        );
        array_push($user_arr["records"], $item);
    }
    http_response_code(200);
    echo json_encode($user_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No se encontraron usuarios."));
}