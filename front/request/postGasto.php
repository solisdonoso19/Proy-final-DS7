<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UsuarioID =  $_POST['UsuarioID'];
    $CategoriaID = $_POST['CategoriaID'];
    $Fecha = $_POST['Fecha'];
    $Cantidad = $_POST['Cantidad'];
    $Descripcion = $_POST['Descripcion'];

    $apiUrl = 'http://localhost/semestral/api/gastos/post.php';
    $postData = array(
        "UsuarioID" => $UsuarioID,
        "Fecha" => $Fecha,
        "Cantidad" => $Cantidad,
        "Descripcion" => $Descripcion,
        "CategoriaID" => $CategoriaID,
    );
    
    $jsonData = json_encode($postData);
    // Inicializa cURL
    $ch = curl_init($apiUrl);
    
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    
    // Configura los encabezados para indicar que estás enviando datos JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Realiza la solicitud y obtén la respuesta
    $response = curl_exec($ch);
    
    // Verifica si la solicitud fue exitosa
    if ($response === false) {
        echo 'Error en la solicitud cURL: ' . curl_error($ch);
    } else {
        echo $response;
    }
    
    // Cierra la sesión cURL
    curl_close($ch);
}