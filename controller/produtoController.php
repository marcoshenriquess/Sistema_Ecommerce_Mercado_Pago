<?php

require_once(dirname(__DIR__) . "/models/produto.php");

class ProdutoControll
{
    public function __construct() {}

    public function ListaProdutoControll($pag)
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ListaProduto($pag);
        return $Produtos;
    }
    public function ProdutosFiltrados($nomeProd, $ordPor, $catPai, $catFilho)
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ProdutosFiltrados($nomeProd, $ordPor, $catPai, $catFilho);
        return $Produtos;
    }
    public function ListaAllProduto()
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ListaAllProduto();
        return $Produtos;
    }
    public function ExportCSVProdutos()
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ExportCSVProdutos();
        return $Produtos;
    }
    public function ListaProdutoPorID($idUsu)
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ListaProdutoPorId($idUsu);
        return $Produtos;
    }
    public function CadastroProdutoControll($produtos)
    {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->CadastrarProdutos($produtos);
        header('Location: produtos.php');
    }
    public function AlterarProdutoControll($produtos, $idUsu, $idProd)
    {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->AlterarProduto($produtos, $idUsu, $idProd);
        header('Location: produtos.php');
    }
    public function ExluirProdutoControll($id)
    {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->ExcluirProduto($id);
    }

    public function ObterProdutoControll($id)
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ObterProduto($id);
        return $Produtos;
    }
    public function ItemsAleatorios()
    {
        $AuxProduto = new ProdutoModel();
        $Produtos = $AuxProduto->ItemsAleatorios();
        return $Produtos;
    }
    public function AtualizarQuantidade($id, $qtde)
    {
        $AuxProduto = new ProdutoModel();
        $AuxProduto->AtualizarQuantidade($id, $qtde);
    }
    public function PesquisaProduto($produto)
    {
        $AuxProduto = new ProdutoModel();

        try {
            // Chamando o método do modelo para buscar os produtos
            $result = $AuxProduto->PesquisaProdutos($produto);

            if (!empty($result)) {
                // Verificando se a consulta retornou resultados
                if (empty($result)) {
                    return ['message' => 'Nenhum produto encontrado.'];
                }

                // Retornando os resultados encontrados
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            // Tratando erros inesperados
            return ['error' => 'Erro ao buscar produtos: ' . $e->getMessage()];
        }
    }
}
