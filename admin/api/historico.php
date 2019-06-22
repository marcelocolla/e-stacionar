<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/historico.php');
require_once('../controller/DBUtils.php');
   
getHistorico();

function returnSelect($_prPlaca){
    $hist = new historico();
    $dbutil = new DBUtils();
    $campos = 'h.Id_historico, h.T_inicial, h.T_final, h.Placa';
    $table = sprintf("%s AS h", $hist->getCampo('tabela'));
    $condicao = sprintf("h.Placa = %s", $dbutil->paraTexto($_prPlaca));
    $sql = sprintf("SELECT %s FROM %s WHERE %s",
        $campos,
        $table,
        $condicao
    );
    return $sql;

}

function getHistorico()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $dbUtil = new DBUtils();
    $result = mysqli_query($db, returnSelect($_POST['placa']));

    $response = array();

    
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }

    
    echo json_encode(array(
        'success' => true,
        'message' => 'Dados encontrados!',
        'result' => $response,
        'placa' => $_POST['placa']

    ));
}

