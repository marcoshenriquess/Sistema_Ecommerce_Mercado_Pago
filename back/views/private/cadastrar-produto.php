<?php 


require_once('C:/xampp/htdocs/project/back/models/produto.php');
require_once('C:/xampp/htdocs/project/back/controller/produtoController.php');
require_once("C:/xampp/htdocs/project/back/controller/TipoProdutoController.php");

$produtoDAO = new TipoProdutoController();
$TipoProd = $produtoDAO->ListarTipoProduto();



if (isset($_POST['cadastrar'])) {
    $produtos = new ProdutoModel(
        null,
        $_POST['nome'],
        $_POST['tipo_prod'],
        $_POST['preco_custo'],
        $_POST['preco_venda'],
        $_POST['descricao'],
        $_POST['desconto'],
        'teste.jpg',
        1,
    );
    if (isset($_FILES['imagem'])) {
        $produtos->setImagem($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produtos->getImagemDiretorio());
    }
    
    $produtoDAO = new ProdutoControll();
    $produtoDAO->CadastroProdutoControll($produtos);
    
}

include_once('./menu.php');
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
                            <select id="tipo_prod" name="tipo_prod" class="form-control" id="TipoProduto">
                                <option selected required disabled >-- SELECIONAR --</option>
                                <?php foreach($TipoProd as $tipo): ?>
                                    <option value="<?= $tipo['id_tipo_prod'] ?>"><?= $tipo['tipo_prod_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Exemplo de textarea</label>
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
                        <div class="mb-3 col">
                            <label for="VendedorProduto" class="form-label">Vendedor</label>
                            <input id="id_vendedor" name="id_vendedor" type="text" class="form-control" id="VendedorProduto" aria-describedby="Vendedor do produto">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="imagem">Envie uma imagem do produto</label>
                        <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem" required>
                    </div>
                    <button name="cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('./footer.php'); ?>