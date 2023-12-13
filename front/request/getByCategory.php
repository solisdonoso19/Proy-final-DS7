<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $categoryID = $_POST['categoryID'];

    $apiUrl = 'http://localhost/semestral/api/gastos/getByCategory.php';
    $postData = array(
        'UsuarioID' => $userID,
        "CategoriaID"  => $categoryID ,
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
        $data = json_decode($response, true)['records'];
        $s = '';
        foreach ($data as $valor) {
            $GastoID = $valor['GastoID'];
            $UsuarioID = $valor['UsuarioID'];
            $Fecha = $valor['Fecha'];
            $Cantidad = $valor['Cantidad'];
            $Descripcion = $valor['Descripcion'];
            $CategoriaID = $valor['CategoriaID'];
            $NombreCategoria = $valor['NombreCategoria'];
            $s = $s . '<tr>';
            $s = $s . '<td style="cursor: pointer;">✏️</td>';
            $s = $s . '<td>' . $GastoID . '</td>';
            $s = $s . '<td>' . $Fecha . '</td>';
            $s = $s . '<td>' . $NombreCategoria . '</td>';
            $s = $s . '<td>' . $Descripcion . '</td>';
            $s = $s . '<td>' . $Cantidad . '</td>';
            $s = $s . '<td onclick="deleteGasto(' . $GastoID . ')" style="cursor: pointer;">🗑️</td>';
            $s = $s . '</tr>';
        }
        echo $s;
    }
    
    // Cierra la sesión cURL
    curl_close($ch);
}