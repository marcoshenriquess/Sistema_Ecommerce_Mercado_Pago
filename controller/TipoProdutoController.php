<?php

    require_once(dirname(__DIR__) ."/models/tipoProdutos.php");

    class TipoProdutoController{
        public function __construct(){

        }

        public function ListarTipoProduto() {
            $AuxTpProd = new TipoProdutoModel();
            $TiposProd = $AuxTpProd->ListTipoProduto();

            return $TiposProd;
        }
    }

?>