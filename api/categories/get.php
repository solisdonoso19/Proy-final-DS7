<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once ('../config/conection.php');
include_once('../class/categories.php');

$conn = new Conection();
$db = $conn->getConection();

$categories = new Categories($db);

$stmt =  $categories->get();
$num  = $stmt->rowCount();

if ($num > 0) {
    $categories_arr = array();
    $categories_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $item = array(
            "CategoriaID" => $CategoriaID,
            "NombreCategoria" => $NombreCategoria,
        );
        array_push($categories_arr["records"], $item);
    }
    http_response_code(200);
    echo json_encode($categories_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No se encontraron Categorias."));
}