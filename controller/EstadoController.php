<?php




require_once('C:/xampp/htdocs/project/models/estado.php');

class EstadoControll {
    public function listarEstados() {
        $AuxCOntroll = new EstadoModel();
        $EstadoBuscado = $AuxCOntroll->ListEstado();
        return $EstadoBuscado;
    }
}