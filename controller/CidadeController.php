<?php




require_once('C:/xampp/htdocs/project/models/cidade.php');

class CidadeControll {
    public function listarCidades() {
        $AuxCOntroll = new CidadeModel();
        $cidadeBuscado = $AuxCOntroll->ListCidade();
        return $cidadeBuscado;
    }
}