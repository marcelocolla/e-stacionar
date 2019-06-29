<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/historico.php');
require_once('../controller/DBUtils.php');
   
getHistorico();

function returnSelect($_prPlaca){

    $hist = new historico();
    $dbutil = new DBUtils();
    $campos = 'h.Id_usuario, h.T_inicial, h.T_final, h.Placa, h.ativo';
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
    
    $result = mysqli_query($db, returnSelect($_POST['Placa']));

    $response = array();

    
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;

    }
    $dataFinal = strtotime($response[count($response)-1]['T_final']);
    $dataAtual = strtotime(date("Y-m-d H:i:s"));
    $situacao = "";
    if($dataAtual > $dataFinal and intval($response[count($response)-1]['ativo']) == 1){
        $situacao = "Tempo Excedido";
    }
    $ativo = (intval($response[count($response)-1]['ativo']) == 1) ? "Ativo" : "Inativo";
    $response[count($response)-1]['situacao'] = $situacao;
    $response[count($response)-1]['ativo'] = $ativo;
    
    echo json_encode(array(
        'success' => true,  
        'message' => 'Dados encontrados!',
        'result' => $response[count($response)-1],
        'situacao' => $situacao,
        'ativo' => $ativo

    ));
}

