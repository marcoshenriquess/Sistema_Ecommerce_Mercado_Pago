<?php


session_start();

require_once('../../controller/produtoController.php');
require_once('../../models/produto.php');

$AuxProdControll = new ProdutoControll();

$arquivo = $_FILES['file-csv'];

if($arquivo['type'] == 'text/csv'){
    $dados_file = fopen($arquivo['tmp_name'], 'r');

    fgetcsv($dados_file, 1000, ';');
    while($linha = fgetcsv($dados_file, 1000, ';')){
        $produtos = new ProdutoModel(
             null,
            $linha[1],
            $linha[2],
            $linha[4],
            $linha[5],
            $linha[3],
            $linha[6],
            $linha[7],
            $linha[8],
            $_SESSION['usuario_logado']['usu_id'],
            null,
            null,
            null
        );
        // echo '<pre>';
        // var_dump($produtos);
        // echo '</pre>';
        $AuxProdControll->CadastroProdutoControll($produtos);
        // var_dump("CERTOO");exit();
    }
} else {
    // var_dump("ERRROOOO");exit();
    header('Location: produtos.php');
}

// $linha[1],
// $linha[2],
// $linha[4],
// $linha[5],
// $linha[3],
// $linha[6],
// $linha[7],
// null,
// $linha[10],
// null,
// null,
// null

