<?php

    require_once('C:/xampp/htdocs/project/back/models/tipoProdutos.php');

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