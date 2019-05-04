<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/usuario.php');
require_once('../controller/DBUtils.php');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        insertData();
        break;

    case 'GET':
    default:
        getData();
}


function insertData()
{
    // if (!empty($_POST)) {
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $usuario = new usuario();
    $dbutil = new DBUtils();
    $usuario->setCampo('Nome', $dbutil->paraTexto($_POST['Nome']));
    $usuario->setCampo('Cpf', $dbutil->paraTexto($_POST['Cpf']));
    $usuario->setCampo('Email', $dbutil->paraTexto($_POST['Email']));
    $usuario->setCampo('Senha', $dbutil->paraTexto($_POST['Senha']));
    $sql = $dbutil->Insert($usuario);
    if (mysqli_query($db, $sql)) {
        echo json_encode(array(
            'success' => true,
            'message' => 'Registro inserido com sucesso!'
        ));
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Falhar ao inserir registro, por favor tente novamente!',
            'error' => mysqli_error($db)
        ));
    }

    // } else {
    //     header("Location: index.php");
    // }
}

function getData()
{
    $json_str = file_get_contents('php://input');

    # Get as an object
    $request_json = json_decode($json_str);
    $id = $request_json->Id_usuario;

    if (!empty($id)) {
        // location;
    } else {
        getAllUsers();
    }
}

function getAllUsers()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();

    $table = 'usuario';
    $result = mysqli_query($db, "SELECT * FROM " . $table);

    // Initialize array variable
    $response = array();

    // Fetch into associative array
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }

    // Print array in JSON format
    echo json_encode($response);
}
