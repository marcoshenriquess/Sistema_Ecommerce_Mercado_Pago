<?php

    require_once("C:/xampp/htdocs/project/models/produto.php");


class ProdutoControll{
    public function __construct(){
    }

    public function ListaProdutoControll()      {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ListaProduto();
        return $Produtos;
    }
    public function ListaProdutoPorID($idUsu)      {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ListaProdutoPorId($idUsu);
        return $Produtos;
    }
    public function CadastroProdutoControll($produtos)      {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->CadastrarProdutos($produtos);
        header('Location: produtos.php');
    }
    public function AlterarProdutoControll($produtos, $idUsu, $idProd)      {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->AlterarProduto($produtos, $idUsu, $idProd);
        header('Location: produtos.php');
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