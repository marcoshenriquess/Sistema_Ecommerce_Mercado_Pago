<?php

    require_once(dirname(__DIR__) ."/models/CategoriaPai.php");

    class CategoriaPaiController{
        public function __construct(){

        }

        public function ListaCategorias() {
            $AuxTpProd = new CategoriaPaiModel();
            $TiposProd = $AuxTpProd->ListaCategorias();

            return $TiposProd;
        }
    }

?>