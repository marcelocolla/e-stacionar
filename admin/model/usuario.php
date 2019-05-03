<?php

class usuario
{
    private $Nome = null;
    private $Cpf = null;
    private $Email = null;
    private $Senha = null;
    private $tabela = 'usuario';

    public function setCampo($_prCampo, $_prValue) {
      $this->$_prCampo = $_prValue;
    }

    public function getCampo($_prCampo) {
        return $this->$_prCampo;
    }

}