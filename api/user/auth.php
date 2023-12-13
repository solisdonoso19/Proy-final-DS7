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

if(!empty($data->CorreoElectronico) && !empty($data->Contrasena)){
    $user->Contrasena = $data->Contrasena;
    $user->CorreoElectronico = $data->CorreoElectronico;

    $userData = $user->auth();
    $num = $userData->rowCount();
        
    if ($num > 0) {
        $user_arr = array();
        $user_arr["records"] = array();
            
        while ($row = $userData->fetch(PDO::FETCH_ASSOC)) {
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
        $u = $user_arr['records'][0];
        if($u['Contrasena'] === $data->Contrasena){
            echo json_encode(array("message" => 1,
                                    "user"=> $u
        ));
        }else{
            echo 0;
        }
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Usuario no encontrado"));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"Los datos estan incompletos"));
}