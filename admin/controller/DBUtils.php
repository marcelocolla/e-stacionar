<?php
date_default_timezone_set("America/Sao_Paulo");

class DBUtils
{
    private $campos = '';

    private $valores = '';

    private $update = '';

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param object $_prClass objeto que sera utilizado para fazer o insert
     *
     * Metodo utilizado para gerar um insert para o banco de dados
     *
     * @return string contendo a "query" de inserção.
     */
    public function Insert(&$_prClass)
    {
        foreach ($_prClass->GetClassVars() AS $key => $atribute) {
            // verifica se o atributo é tabela, se for não considera neste ponto
            if ($atribute != 'tabela') {
                // valida se a posição é zero, se for não insere virgula
                if ($_prClass->getCampo($atribute)) {
                    if ($key == 0) {
                        $this->campos = sprintf("%s", $atribute);
                        $this->valores = sprintf("%s", $_prClass->getCampo($atribute));
                    } else {
                        $this->campos .= sprintf(", %s", $atribute);
                        $this->valores .= sprintf(", %s", $_prClass->getCampo($atribute));
                    }
                }
            }
        }
        return sprintf("INSERT INTO %s (%s) VALUES (%s)", $_prClass->getCampo('tabela'), $this->campos, $this->valores);
    }

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param object $_prClass model da tabela a qual sera feito o update
     * @param string $_prCondicao condição do update
     * @return string
     *
     * metodo utilizado para criar dinamicamente o update de acordo com o model recebido.
     */
    public function Update(&$_prClass, $_prCondicao)
    {
        foreach ($_prClass->GetClassVars() AS $key => $atribute) {
            // verifica se possui valor atribuido no atributo em questão
            if ($_prClass->getCampo($atribute)) {
                // verifica se o campo é tabela, se for ele não considera para formar o update
                if ($atribute != 'tabela') {
                    // validação utilizada para que só insira virgula caso não seja a primeira posição
                    if ($key == 0) {
                        $this->update = sprintf("%s = %s", $atribute, $_prClass->getCampo($atribute));
                    } else {
                        $this->update = sprintf(", %s = %s", $atribute, $_prClass->getCampo($atribute));
                    }
                }
            }
        }
        return sprintf("UPDATE %s SET %s %s", $_prClass->getCampo('tabela'), $this->update, $_prCondicao);
    }

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param mixed $_prSTRING
     * @param bool $_prRemoveSpacos
     *
     * recebe um valor qualquer e converte para string para ser utilizado no insert do banco de dados onde o mesmo espera
     * um texto.
     * @return string
     */
    function paraTexto($_prSTRING, $_prRemoveSpacos = false)
    {
        // Faz o Scape nas aspas por causa do Mysql
        $_prSTRING = str_replace("'", "''", $_prSTRING);
        if ($this->isBool($_prRemoveSpacos)) {
            $_prSTRING = trim($_prSTRING);
        }
        return sprintf("'%s'", $_prSTRING);
    }

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param mixed $_prValor valor utilizado para a verificação
     *
     * utilizado para validar condições boolean, onde caso for qualquer um dos 4 valores, retorna 1, caso contrario
     * retorna 0.
     * @return int 1/0
     */
    function isBool($_prValor)
    {
        if ($_prValor === 'true' or $_prValor === true or $_prValor === '1' or $_prValor === 1) {
            return 1;
        }
        return 0;
    }
}