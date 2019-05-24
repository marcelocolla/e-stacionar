<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/historico.php');
require_once('../controller/DBUtils.php');


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        insertHora();
        break;

    case 'GET':
    default:
        getData();
}

function returnSelect($_prPlaca)
{
    $hist = new historico();
    $dbutil = new DBUtils();
    // Separa o Select em partes para não ficar uma linha muito extensa.
    $campos = ' h.Id_historico, h.T_inicial, h.T_final, v.Placa';
    $table = sprintf("%s AS h", $hist->getCampo('tabela'));
    $joinUsuario = 'JOIN usuario AS u ON h.Id_usuario = u.Id_usuario';
    $joinVeiculo = 'JOIN veiculo AS v ON u.Id_usuario = v.Id_usuario';
    $condicao = sprintf("v.Placa = %s", $dbutil->paraTexto($_prPlaca));
    $sql = sprintf("SELECT %s FROM %s %s %s WHERE %s",
        $campos,
        $table,
        $joinUsuario,
        $joinVeiculo,
        $condicao
    );
    return $sql;
}

function insertHora()
{
    // if (!empty($_POST)) {
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $hist = new historico();
    $dbutil = new DBUtils();
    $result = mysqli_query($db, returnSelect($_POST['placa']));
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    if (!$response) {
        $hist->setCampo('T_inicial', $dbutil->paraTexto($_POST['hora_inicio']));
        $hist->setCampo('T_final', $dbutil->paraTexto($_POST['hora_fim']));
        $hist->setCampo('Id_usuario', $dbutil->paraTexto($_POST['id_usr']));
        $sql = $dbutil->Insert($hist);
        if (mysqli_query($db, $sql)) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Registro inserido com sucesso!',
                'placa' => $response[0]['Placa']
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
            'message' => 'Já possui um veiculo com uma contagem ativa!',
            'id' => $response[0]['Id_historico'],
            'data_inicio' => $response[0]['T_inicial'],
            'data_final' => $response[0]['T_final'],
            'placa' => $response[0]['Placa']
        ));
    }
}

function getData()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $result = mysqli_query($db, returnSelect($_POST['placa']));
    // Initialize array variable
    $response = array();

    // Fetch into associative array
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }

    // Print array in JSON format
    echo json_encode(array(
        'success' => true,
        'message' => 'Contagem ativa!',
        'result' => $response,
        'id' => $response[0]['Id_historico'],
        'data_inicio' => $response[0]['T_inicial'],
        'data_final' => $response[0]['T_final'],
        'placa' => $response[0]['Placa']
    ));
}
