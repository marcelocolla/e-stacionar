<?php

class DBUtils
{
    private $StlFCAMPOS = array();

    /**
     * @author Leonardo Thomaz
     * @since 05/04/2019
     * @param string $_prTABELA nome da tabela a qual será inserido os dados
     * @param string $_prCampos campos do banco que receberam os dados
     * @param string $_prValores valores que irão popular as colunas
     *
     * Metodo utilizado para inserir dados no banco de dados
     */
    public function Insert($_prTABELA, $_prCampos, $_prValores)
    {
        $this->StlFCAMPOS[] = 'INSERT INTO ' . $_prTABELA . $_prCampos . ' VALUES ' . $_prValores;
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
}