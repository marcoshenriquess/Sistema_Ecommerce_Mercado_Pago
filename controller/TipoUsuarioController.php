<?php 
    
    require_once(dirname(__DIR__) ."/models/tipousuarios.php");

    class TipoUserControll{
        public function __construct(){

        }
        public function ListarTipoUser(){
            $AuxCOntroll = new TipoUsuarioModel();
            $TipoBuscado = $AuxCOntroll->Listar();
            return $TipoBuscado;
        }
        public function ObeterTipoUser($id){
            $AuxCOntroll = new TipoUsuarioModel();
            $TipoBuscado = $AuxCOntroll->ObterID($id);
            return $TipoBuscado;
        }
    }


?>