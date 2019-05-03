<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');

authUser();

function authUser () {
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $table = 'usuario';

    // params
    $email = $_GET['email'];
    $senha = $_GET['senha'];

    $query = "SELECT * FROM " . $table . " where Email = '$email' AND Senha = '$senha'";
    $result = mysqli_query($db, $query);
    $response = mysqli_fetch_assoc($result);

    if ($result->num_rows > 0) {
        // start a session
        session_start();

        // initialize session variables
        $_SESSION['user'] = $response;

        echo json_encode(array(
            'success' => true,
            'message' => 'Acesso permitido, as credenciais são validas',
            'data' => $response
        ));
    } else {
        echo json_encode(array(
            'status' => 401,
            'success' => false,
            'message' => 'E-mail ou senha inválidos',
            'error' => mysqli_error($db)
        ));

        http_response_code(401);
    }

    exit();
}
