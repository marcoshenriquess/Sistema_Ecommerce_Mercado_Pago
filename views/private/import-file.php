<?php


session_start();

require_once('../../controller/produtoController.php');
require_once('../../models/produto.php');

$AuxProdControll = new ProdutoControll();

$arquivo = $_FILES['file-csv'];

if ($arquivo['type'] == 'text/csv') {
    $dados_file = fopen($arquivo['tmp_name'], 'r');

    $teste = fgetcsv($dados_file, 1000, ';');
    while ($linha = fgetcsv($dados_file, 1000, ';')) {
        if (count($linha) >= 8 /* numero de campos obrigatórios */) {
            $produtos = new ProdutoModel(
                null,
                $linha[1],
                $linha[2],
                $linha[3],
                $linha[5],
                $linha[4],
                $linha[8],
                null,
                $linha[11],
                $linha[12],
                $linha[13],
                $linha[14],
                null,
                null,
                $_SESSION['usuario_logado']['usu_id'],
                null,
                null,
                null,
            );
            $erro = $AuxProdControll->CadastroProdutoControll($produtos);
            
        }
    }
    if($erro != false){
        echo "Erro ao cadastrar produto";
    }
} else {
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
?>