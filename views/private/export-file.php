<?php



require_once('../../controller/produtoController.php');

$AuxProdControll = new ProdutoControll();
$Dados = $AuxProdControll->ExportCSVProdutos();

if(($Dados) and ($Dados->rowCount() != 0)){

    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=arquivo.csv');

    $resultado = fopen("php://output", "w");
    
    fwrite($resultado, "\xEF\xBB\xBF");

    $cabecalho = ['ID', 'Nome', 'Descricao', 'Imagem', 'Categoria Pai_ID','Categoria Filho_ID', 'Categoria Pai','Categoria Filho','Marca_id', 'Marca','tamanho', 'estoque','custo', 'venda','desconto','avaliacao','quantidade de Venda','Vendedor', 'data cadastro', 'status', 'data exclusão'];
    fputcsv($resultado, $cabecalho, ';');

    $aux = "";
    $Produtos = $AuxProdControll->ListaAllProduto($aux);
    foreach($Produtos as $key => $element){
        extract($element);
        fputcsv($resultado, $element, ';');
    }


    fclose($resultado);

    // echo '<p style="color:green;">Certo: produto encontrado!</p>';
} else {
    echo '<p style="color:red;">Erro: Nenhum produto encontrado!</p>';
}


