<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/historico.php');
require_once('../controller/DBUtils.php');


finalizarContador();

function returnSelect($_prPlaca)
{
    $hist = new historico();
    $dbutil = new DBUtils();
    // Separa o Select em partes para não ficar uma linha muito extensa.
    $campos = ' h.Id_historico';
    $condicao = sprintf("h.placa = %s AND h.ativo = 1", $dbutil->paraTexto($_prPlaca));
    $sql = sprintf("SELECT %s FROM %s AS h WHERE %s",
        $campos,
        $hist->getCampo('tabela'),
        $condicao
    );
    return $sql;
}

function finalizarContador()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $hist = new historico();
    $dbutil = new DBUtils();
    $placa = $_POST['placa'];
    $result = mysqli_query($db, returnSelect($placa));
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    if ($response) {
        $hist->setCampo('T_final', $dbutil->paraTexto(Date("Y-m-d H:i:s")));
        $hist->setCampo('ativo', 0);
        $condicao = sprintf("Id_historico = %s", $response[0]['Id_historico']);
        $sql = sprintf("UPDATE %s SET T_final = %s, ativo = %s WHERE %s",
            $hist->getCampo('tabela'),
            $hist->getCampo("T_final"),
            $hist->getCampo("ativo"),
            $condicao
        );
        if (mysqli_query($db, $sql)) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Tempo registrado com sucesso!'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'não foi possivel concluir o uso de tempo!',
                'error' => mysqli_error($db)
            ));
        }
    }
}
