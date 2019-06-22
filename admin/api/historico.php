<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/historico.php');
require_once('../controller/DBUtils.php');

getHistorico();

function returnSelect($_prId_usuario){

    $hist = new historico();
    $dbutil = new DBUtils();
    $campos = 'h.Id_usuario, h.T_inicial, h.T_final, h.Placa';
    $table = sprintf("%s AS h", $hist->getCampo('tabela'));
    $condicao = sprintf("h.Id_usuario = %s", $dbutil->paraTexto($_prId_usuario));
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
    session_start();
    $user = $_SESSION['user'];
    $result = mysqli_query($db, returnSelect($user['Id_usuario']));
      
   

    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }


    echo json_encode(array(
        'success' => true,
        'message' => 'Dados encontrados!',
        'result' => $response,
        'Id_usuario' => $user['Id_usuario']

    ));
}
