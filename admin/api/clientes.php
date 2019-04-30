<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        insertData();
        break;

    case 'GET':
    default:
        getData();
}


function insertData () {
    // if (!empty($_POST)) {
        $con = new DBConect();
        $con->Conectar();
        $db = $con->getConexao();

        $table = 'usuario';

        $json_str = file_get_contents('php://input');

        # Get as an object
        $request_json = json_decode($json_str);

        $nome = $request_json->Nome;
        $cpf = $request_json->Cpf;
        $email = $request_json->Email;
        $senha = $request_json->Senha;

        $sql = "INSERT INTO " . $table . " (Nome, Cpf, Email, Senha) VALUES ('$nome', '$cpf', '$email', '$senha')";

        $array = json_decode($json, true);

        if (mysqli_query($db, $sql)) {
            echo json_encode(array(
                'success'=> true,
                'message'=> 'Registro inserido com sucesso!'
            ));
        } else {
            echo json_encode(array(
                'success'=> false,
                'message'=> 'Falhar ao inserir registro, por favor tente novamente!',
                'error'  => mysqli_error($db)
            ));
        }

    // } else {
    //     header("Location: index.php");
    // }
}

function getData () {
    $json_str = file_get_contents('php://input');

    # Get as an object
    $request_json = json_decode($json_str);
    $id = $request_json->Id_usuario;

    if (!empty($id)) {
        getUser($id);
    } else {
        getAllUsers();
    }
}

function getUser ($id) {
    // $con = new DBConect();
    // $con->Conectar();
    // $db = $con->getConexao();

    // $table = 'usuario';
    // $result = mysqli_query($db, "SELECT * FROM " . $table . " where Id_usuario = " . $id);

    // Print array in JSON format
    echo json_encode(array(
        'Id_usuario' => $id,
        'Nome' => 'Nome do Tcho'
    ));
}

function getAllUsers () {
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();

    $table = 'usuario';
    $result = mysqli_query($db, "SELECT * FROM " . $table);

    // Initialize array variable
    $response = array();

    // Fetch into associative array
    while ($row = mysqli_fetch_assoc($result))  {
        $response[] = $row;
    }

    // Print array in JSON format
    echo json_encode($response);
}
