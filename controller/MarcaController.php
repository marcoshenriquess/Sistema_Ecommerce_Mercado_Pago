<?php

require_once(dirname(__DIR__) ."/models/marca.php");

class MarcaController{
    public function __construct(){
        
    }

    public function ListarMarcas()
    {
        $AuxMarcaControll = new MarcaModel();
        $result = $AuxMarcaControll->ListaMarcas();

        return $result;
    }

}


?>