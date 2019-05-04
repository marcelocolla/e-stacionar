<?php


class DBUtils
{
    private $campos = '';

    private $valores = '';

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param object $_prClass objeto que sera utilizado para fazer o insert
     *
     * Metodo utilizado para inserir dados no banco de dados
     *
     * @return string
     */
    public function Insert(&$_prClass)
    {
        foreach ($_prClass->GetClassVars() AS $key => $atribute) {
            if ($atribute != 'tabela') {
                if ($key == 0) {
                    $this->campos = sprintf("%s", $atribute);
                    $this->valores = sprintf("%s", $_prClass->getCampo($atribute));
                } else {
                    $this->campos .= sprintf(", %s", $atribute);
                    $this->valores .= sprintf(", %s", $_prClass->getCampo($atribute));
                }
            }
        }
        return sprintf("INSERT INTO %s (%s) VALUES (%s)", $_prClass->getCampo('tabela'), $this->campos, $this->valores);
    }

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param string $_prTABELA nome da tabela a qual será inserido os dados
     * @param string $_parCONDICAO condição do insert
     *
     * metodo utilizado para atualizar dados no banco de dados.
     */
    public function Update($_prTABELA, $_parCONDICAO)
    {
        $this->StlFCAMPOS[] = 'UPDATE ' . $_prTABELA . ' SET ' . $_parCONDICAO;
    }

    function paraTexto($_prSTRING, $_prRemoveSpacos = false)
    {
        // Faz o Scape nas aspas por causa do Mysql
        $_prSTRING = str_replace("'", "''", $_prSTRING);
        if ($this->isBool($_prRemoveSpacos)) {
            $_prSTRING = trim($_prSTRING);
        }
        return sprintf("'%s'", $_prSTRING);
    }

    function isBool($_prValor)
    {
        if ($_prValor === 'true' or $_prValor === true or $_prValor === '1' or $_prValor === 1) {
            return 1;
        }
        return 0;
    }
}