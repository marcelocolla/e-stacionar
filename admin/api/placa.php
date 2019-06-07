<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/veiculo.php');
require_once('../controller/DBUtils.php');


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        inserirPlaca();
        break;

    case 'GET':
    default:
        listarPlacaUsuario();
}

function returnSelect($_prCondicao)
{
    $veiculo = new veiculo();
    // Separa o Select em partes para não ficar uma linha muito extensa.
    $campos = 'Placa';
    $sql = sprintf("SELECT %s FROM %s WHERE %s",
        $campos,
        $veiculo->getCampo('tabela'),
        $_prCondicao
    );
    return $sql;
}

function inserirPlaca()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $veiculo = new veiculo();
    $dbutil = new DBUtils();
    // inicia a Session
    session_start();
    // pega as informações do usuário logado.
    $user = $_SESSION['user'];
    $condicaoSelect = sprintf('Placa = %s AND Id_usuario = %s', $dbutil->paraTexto($_POST['placa']), $user['Id_usuario']);
    $response = null;
    $sqlSelect = returnSelect($condicaoSelect);
    $result = mysqli_query($db, $sqlSelect);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    if (!$response) {
        $veiculo->setCampo('Placa', $dbutil->paraTexto($_POST['placa']));
        $veiculo->setCampo('Id_usuario', $user['Id_usuario']);
        $sql = $dbutil->Insert($veiculo);
        if (mysqli_query($db, $sql)) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Placa inserida com sucesso!'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Falha ao inserir registro, por favor tente novamente!',
                'error' => mysqli_error($db)
            ));
        }
    } else {
        echo json_encode(array(
            'success' => true,
            'message' => 'Esta placa já esta cadastrada em nosso banco de dados!'
        ));
    }
}