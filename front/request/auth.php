<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $apiUrl = 'http://localhost/semestral/api/user/auth.php';
    $postData = array(
        'CorreoElectronico' => $email,
        "Contrasena"  => $pass ,
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
        session_start();
        $_SESSION['user'] = $response;
        echo $response;
    }
    
    // Cierra la sesión cURL
    curl_close($ch);
}