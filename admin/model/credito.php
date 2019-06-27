<?php

class credito
{
    private $Saldo = null;

    private $Id_usuario = null;

    private $tabela = 'credito';

    public function setCampo($_prCampo, $_prValue)
    {
        $this->$_prCampo = $_prValue;
    }

    public function getCampo($_prCampo)
    {
        return $this->$_prCampo;
    }

    /**
     * Leonardo Thomaz
     * 04/05/2019
     *
     * Metodo Utilizado para captar os dados da classe informada, para desta forma ser utilizado para formar um insert
     * genérico
     *
     * @return array contendo em casa posição o name do atributo da classe
     */
    function GetClassVars()
    {
        return array_keys(get_class_vars(get_class($this))); // $this
    }
}