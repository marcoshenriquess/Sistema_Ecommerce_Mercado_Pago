<?php

include_once("../../models/permissao.php");
include_once('./menu.php');

require_once('C:/xampp/htdocs/project/models/produto.php');
require_once('C:/xampp/htdocs/project/controller/produtoController.php');
require_once("C:/xampp/htdocs/project/controller/TipoProdutoController.php");

$produtoDAO = new TipoProdutoController();
$TipoProd = $produtoDAO->ListarTipoProduto();


if (isset($_POST['cadastrar'])) {
    if(!isset($_POST['nome'],$_POST['tipo_prod'],$_POST['preco_custo'],$_POST['preco_venda'],$_POST['descricao'],$_POST['quantidade'],$_POST['desconto'])){
        $produtos = new ProdutoModel(
            null,
            $_POST['nome'],
            $_POST['tipo_prod'],
            $_POST['preco_custo'],
            $_POST['preco_venda'],
            $_POST['descricao'],
            $_POST['quantidade'],
            $_POST['desconto'],
            null,
            $_SESSION['usuario_logado']['usu_id'],
            null,
            null,
            null
        );
        if (isset($_FILES['image'])) {
            $produtos->setimagem($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $produtos->getImagemDiretorio());
            // var_dump($produtos->getImagemDiretorio());
            // var_dump(__DIR__ . "/" . $_FILES['image']['name']);
        }
        // var_dump($produtos); exit();
    
        $produtoDAO = new ProdutoControll();
        $produtoDAO->CadastroProdutoControll($produtos);
    } else {
        echo "PREENCHA OS CAMPOS OBRIGATÓRIOS";
    }
}

?>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include_once('header.php') ?>
        <!-- End of Topbar -->

        <!--CONTEUDO -->
        <div class="w-100 p-3 h-100 row justify-content-md-center">
            <div class="w-75">
                <form class="w-80" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="NomeProduto" class="form-label">Nome do Produto</label>
                            <input id="nome" name="nome" type="text" class="form-control" id="NomeProduto" required>
                        </div>
                        <div class="form-group col-md-auto">
                            <label for="TipoProduto">Tipo do Produto</label>
                            <select id="tipo_prod" name="tipo_prod" class="form-control" id="TipoProduto" required>
                                <option selected disabled>-- SELECIONAR --</option>
                                <?php foreach ($TipoProd as $tipo): ?>
                                    <option value="<?= $tipo['id_tipo_prod'] ?>"><?= $tipo['tipo_prod_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="preco">Preço de Custo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input id="preco_custo" name="preco_custo" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="preco">Preço de Venda</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input id="preco_venda" name="preco_venda" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="preco">Desconto</label>
                            <div class="input-group">
                                <span class="input-group-text">%</span>
                                <input id="desconto" name="desconto" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="quantidade">Quantidade</label>
                            <div class="input-group">
                                <input id="quantidade" name="quantidade" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="image">Envie uma image do produto</label>
                        <input id="image" name="image" type="file" accept="imagem/*" placeholder="Envie uma image">
                    </div>
                    <button name="cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('./footer.php'); ?>