<?php




require_once(dirname(__DIR__) ."/models/estado.php");

class EstadoControll {
    public function listarEstados() {
        $AuxCOntroll = new EstadoModel();
        $EstadoBuscado = $AuxCOntroll->ListEstado();
        return $EstadoBuscado;
    }
}