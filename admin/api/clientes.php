<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');

$con = new DBConect();
$con->Conectar();
$db = $con->getConexao();
$result = mysqli_query($db, "SELECT * FROM usuario");

// Initialize array variable
$response = array();

// Fetch into associative array
while ($row = mysqli_fetch_assoc($result))  {
    $response[] = $row;
}


// Print array in JSON format
echo json_encode($response);
