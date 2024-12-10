<?php



require_once('../../controller/produtoController.php');

$AuxProdControll = new ProdutoControll();
$Dados = $AuxProdControll->ExportCSVProdutos();

if(($Dados) and ($Dados->rowCount() != 0)){

    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=arquivo.csv');

    $resultado = fopen("php://output", "w");
    
    fwrite($resultado, "\xEF\xBB\xBF");

    $cabecalho = ['ID', 'Nome', 'Tipo', 'Descricao', 'Custo', 'Venda', 'Estoque', 'Desconto', 'Imagem', 'dt_ini', 'Usu'];
    fputcsv($resultado, $cabecalho, ';');

    
    $Produtos = $AuxProdControll->ListaAllProduto();
    foreach($Produtos as $key => $element){
        extract($element);
        fputcsv($resultado, $element, ';');
    }


    fclose($resultado);

    // echo '<p style="color:green;">Certo: produto encontrado!</p>';
} else {
    echo '<p style="color:red;">Erro: Nenhum produto encontrado!</p>';
}


