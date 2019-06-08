<?php

class DBConect
{
    private $conexao;
//    private $MYSQL_USUARIO = 'bea532f504895e';
//    private $MYSQL_SENHA = '0b610eb9';
//    private $MYSQL_IP = 'us-cdbr-iron-east-02.cleardb.net';
//    private $MYSQL_DATABASE = 'heroku_ab52c01e945ea67';
    private $MYSQL_USUARIO = 'root';
    private $MYSQL_SENHA = '';
    private $MYSQL_IP = 'localhost';
    private $MYSQL_DATABASE = 'estacionar';

    public function getDadosConexao() {
        return array($this->MYSQL_USUARIO, $this->MYSQL_SENHA, $this->MYSQL_IP, $this->MYSQL_DATABASE);
    }

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     *
     * Método utilizado para efetuar conexão com banco de dados.
     */
    public function Conectar()
    {
        global $Sess;

        if (true) {
            // Conecta no Banco de Dados
            $this->conexao = @mysqli_connect($this->MYSQL_IP, $this->MYSQL_USUARIO, $this->MYSQL_SENHA, $this->MYSQL_DATABASE);
            @mysqli_set_charset($this->conexao, 'utf8');
            if (!$this->conexao) {
                $Sess->logado_sys = false;
                echo json_encode(array(
                    "success" => false,
                    "message" => "Erro ao Conectar ao Banco de Dados.",
                    "error" => @mysqli_connect_error()
                ));
                exit();
            }
        } else {
            // $Sess->destroy(true);
            echo json_encode(array(
                "success" => false,
                "message" => "Usuario deslogado do sistema."
            ));
            exit();
        }
    }

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     *
     * Método utilizado para deslogar.
     */
    public function Desconectar()
    {
        @mysqli_close($this->conexao);
    }

    public function getConexao () {
        return $this->conexao;
    }



}
