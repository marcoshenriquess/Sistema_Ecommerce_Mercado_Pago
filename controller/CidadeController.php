<?php




require_once(dirname(__DIR__) ."/models/cidade.php");

class CidadeControll {
    public function listarCidades() {
        $AuxCOntroll = new CidadeModel();
        $cidadeBuscado = $AuxCOntroll->ListCidade();
        return $cidadeBuscado;
    }
}