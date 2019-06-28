<?php
header('Content-Type: application/json');

require_once('../controller/DBConect.php');
require_once('../model/credito.php');
require_once('../controller/DBUtils.php');

insereCredito();

function insereCredito()
{
    $con = new DBConect();
    $con->Conectar();
    $db = $con->getConexao();
    $credito = new credito();
    $dbutil = new DBUtils();
    
    session_start();
    $user = $_SESSION['user'];
    $campos = 'c.Saldo';
    $table = sprintf("Credito AS c");
    $condicao = sprintf("c.Id_usuario = %s", $dbutil->paraTexto($user['Id_usuario']));
    $sql = sprintf("SELECT %s FROM %s WHERE %s",
        $campos,
        $table,
        $condicao
    );
    $result = mysqli_query($db,$sql);
    $response = null;
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    if($response){
        $saldoAtual = ($response) ? $response[0]['Saldo'] : 0; 
        $valorCredito = str_replace("R$ ", "", $_POST['Valor']);
        $valor = floatval($saldoAtual) + floatval($valorCredito);
        $credito->setCampo('Saldo', $valor);
        $credito->setCampo('Id_usuario', $user['Id_usuario']);
        $campos = sprintf('Saldo = %s', $credito->getCampo("Saldo"));
        $condicao = sprintf('Id_usuario = %s', $credito->getCampo("Id_usuario"));
        $sql = sprintf("UPDATE %s SET %s WHERE %s",
            $credito->getCampo("tabela"),
            $campos,
            $condicao
        );
        if (mysqli_query($db, $sql)) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Creditos inseridos com sucesso!',
                'saldototal'=>floatval($saldoAtual) ,
                'saldoCred'=>floatval($valorCredito),
                'VALOR'=>$valor,
                'result'=>$result
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Falha ao inserir Creditos, por favor tente novamente!',
                'error' => mysqli_error($db),
                'valor'=> $valorCredito
            ));
        }
    }
    else
    {
        $valorCredito = str_replace("R$ ", "", $_POST['Valor']);
        $credito->setCampo('Saldo', $valorCredito);
        $credito->setCampo('Id_usuario', $user['Id_usuario']);
        $sql = $dbutil->Insert($credito);

        if (mysqli_query($db, $sql)) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Creditos inseridos com sucesso!'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Falha ao inserir Creditos, por favor tente novamente!',
                'error' => mysqli_error($db),
                'valor'=> $valorCredito
            ));
        }

    }
}