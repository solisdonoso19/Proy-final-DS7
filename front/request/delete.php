<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $GastoID = $_POST['GastoID'];

    $apiUrl = 'http://localhost/semestral/api/gastos/delete.php';
    $postData = array(
        "GastoID" => $GastoID,
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