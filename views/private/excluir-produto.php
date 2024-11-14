<?php


require_once('C:/xampp/htdocs/project/controller/produtoController.php');
$produtosControll = new ProdutoControll();
$produtosControll->ExluirProdutoControll($_POST['id']);

header("location: produtos.php"); 
?>