<?php

    require_once("C:/xampp/htdocs/project/back/models/produto.php");


class ProdutoControll{
    public function __construct(){
    }

    public function ListaProdutoControll()      {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ListarProdutos();
        return $Produtos;
    }
    public function CadastroProdutoControll($produtos)      {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->CadastrarProdutos($produtos);
    }
    public function AlterarProdutoControll($produtos, $id)      {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->AlterarProduto($produtos, $id);
    }
    public function ExluirProdutoControll( $id)      {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->ExcluirProduto($id);
    }

    public function ObterProdutoControll($id)      {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ObterProduto($id);
        return $Produtos;
    }
}


?>