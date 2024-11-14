<?php 

include_once('./menu.php');

require_once('C:/xampp/htdocs/project/models/produto.php');
require_once('C:/xampp/htdocs/project/controller/produtoController.php');
require_once("C:/xampp/htdocs/project/controller/TipoProdutoController.php");

$produtoDAO = new TipoProdutoController();
$TipoProd = $produtoDAO->ListarTipoProduto();


$produtoContr = new ProdutoControll();
$prod = $produtoContr->ObterProdutoControll($_GET['id']);

// var_dump( $prod); exit();

if (isset($_POST['editar'])) {
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
        null,
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
    $produtoDAO->AlterarProdutoControll($produtos,$_SESSION['usuario_logado']['usu_id'], $_GET['id']);
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
                            <input name="nome" type="text" class="form-control" id="nome" value="<?= $prod['prod_nome'] ?>" required>
                        </div>
                        <div class="form-group col-md-auto">
                            <label for="TipoProduto">Tipo do Produto</label>
                            <select id="tipo_prod" name="tipo_prod" class="form-control" id="TipoProduto">
                                <option selected required disabled >-- SELECIONAR --</option>
                                <?php foreach($TipoProd as $tipo): ?>
                                    <option value="<?= $tipo['id_tipo_prod'] ?>" <?= ($prod['prod_tipo'] == $tipo['id_tipo_prod'] ) ? 'selected' : '' ?>><?= $tipo['tipo_prod_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Exemplo de textarea</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="3" required><?= $prod['prod_descricao'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="preco">Preço de Custo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input id="preco_custo" name="preco_custo" type="text" class="form-control" value="<?= $prod['prod_custo'] ?>" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="preco">Preço de Venda</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input id="preco_venda" name="preco_venda" type="text" class="form-control" value="<?= $prod['prod_venda'] ?>" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="preco">Desconto</label>
                            <div class="input-group">
                                <span class="input-group-text">%</span>
                                <input id="desconto" name="desconto" type="number" class="form-control" value="<?= $prod['prod_desconto'] ?>" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="quantidade">Quantidade</label>
                            <div class="input-group">
                                <input id="quantidade" name="quantidade" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $prod['prod_quantidade'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="image">Envie uma image do produto</label>
                        <input id="image" name="image" type="file" accept="imagem/*" placeholder="Envie uma image">
                    </div>
                    <button name="editar" type="submit" class="btn btn-primary">Alterar</button>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('./footer.php'); ?>