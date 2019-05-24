<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/usuario.php');
require_once('../controller/DBUtils.php');

authUser();

function authUser()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $usuario = new usuario();
    $dbUtl = new DBUtils();

    // params
    $usuario->setCampo("Email", $dbUtl->paraTexto($_GET['email']));
    $usuario->setCampo("Senha", $dbUtl->paraTexto(MD5($_GET['senha'])));

    $query = sprintf("SELECT * FROM %s WHERE Email = %s AND Senha = %s",
        $usuario->getCampo("tabela"),
        $usuario->getCampo("Email"),
        $usuario->getCampo("Senha")
    );

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
