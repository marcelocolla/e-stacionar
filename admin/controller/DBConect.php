<?php

class DBConect
{
    private $conexao;
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
        if ($Sess->logado()) {
            // Conecta no Banco de Dados
            $this->conexao = @mysqli_connect($this->MYSQL_IP, $this->MYSQL_USUARIO, $this->MYSQL_SENHA, $this->MYSQL_DATABASE);
            @mysqli_set_charset($this->conexao, 'utf8');
            if (!$this->conexao) {
                $Sess->logado_sys = false;
                echo json_encode(array(
                    "success" => false,
                    "msg" => "Erro ao Conectar ao Banco de Dados.",
                    "erro" => 1,
                    "error" => @mysqli_connect_error()
                ));
                exit();
            }
        } else {
            $Sess->destroy(true);
            echo json_encode(array(
                "success" => false,
                "msg" => "Usuario deslogado do sistema."
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



}