<?php 

include_once("../../models/permissao.php");

Verificar_Permissão_Pag();
require_once("../../models/produto.php");
require_once("../../controller/produtoController.php");
require_once("../../controller/CategoriaPaiController.php");
require_once("../../controller/CategoriaFilhoController.php");
require_once("../../controller/MarcaController.php");

$AuxControllPai = new CategoriaPaiController();
$CategoriaPai = $AuxControllPai->ListaCategorias();

$AuxMarcaControll = new MarcaController();
$MarcaList = $AuxMarcaControll->ListarMarcas();

$produtoContr = new ProdutoControll();
$prod = $produtoContr->ObterProdutoControll($_GET['id']);

$AuxControllFilho = new CategoriaFilhoModel();
$CategoriaFilho = $AuxControllFilho->ListaCategorias($prod['prod_categoria_pai']);

if (isset($_POST['editar'])) {
    $produtos = new ProdutoModel(
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null
    );
    if (isset($_FILES['image'])) {
        $produtos->setimagem($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $produtos->getImagemDiretorio());
    }
    $produtoDAO = new ProdutoControll();
    $produtoDAO->AlterarProdutoControll($produtos,$_SESSION['usuario_logado']['usu_id'], $_GET['id']);
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
                <form class="w-80 mt-5  bg-light shadow radius-ajuste p-5" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="NomeProduto" class="form-label">Nome do Produto</label>
                            <input id="nome" name="nome" type="text" class="form-control" id="NomeProduto" value="<?= $prod['prod_nome'] ?>" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="marca">Marca</label>
                            <select id="marca" name="marca" class="form-control" id="marca" required>
                                <option selected disabled>-- SELECIONAR --</option>
                                <?php foreach ($MarcaList as $marca): ?>
                                    <option value="<?= $marca['marc_id'] ?>"><?= $marca['marc_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col">
                            <label for="CategoriaPai">Categoria Pai</label>
                            <select id="catPai" name="catPai" class="form-control" id="CategoriaPai" onchange="javascript:mostraCatFilho(this)" required>
                                <option selected disabled>-- SELECIONAR --</option>
                                <?php foreach ($CategoriaPai as $tipo): ?>
                                    <option value="<?= $tipo['catPai_id'] ?>" <?= ($prod['prod_categoria_pai'] == $tipo['catPai_id']) ? 'selected' : '' ?>><?= $tipo['catPai_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col">
                            <label for="CategoriaFilho">Categoria Filho</label>
                            <select id="catFilho" name="catFilho" class="form-control" id="CategoriaFilho" required>
                                <option selected disabled>-- SELECIONAR --</option>
                                <?php foreach ($CategoriaFilho as $tipoF): ?>
                                    <option value="<?= $tipoF['catFilho_id'] ?>" <?= ($prod['prod_categoria_filho'] == $tipoF['catFilho_id']) ? 'selected' : '' ?>><?= $tipoF['catFilho_nome']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?= $prod['prod_descricao'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="preco">Preço de Custo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input id="preco_custo" name="preco_custo" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required value="<?= $prod['prod_custo'] ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="preco">Preço de Venda</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input id="preco_venda" name="preco_venda" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required value="<?= $prod['prod_venda'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="preco">Desconto</label>
                            <div class="input-group">
                                <span class="input-group-text">%</span>
                                <input id="desconto" name="desconto" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" required value="<?= $prod['prod_desconto'] ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="estoque">Estoque</label>
                            <div class="input-group">
                                <input id="estoque" name="estoque" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required value="<?= $prod['prod_estoque'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-5 d-flex flex-column justify-content-md-left">
                        <label for="image">Envie uma image do produto</label>
                        <input id="image" name="image" type="file" accept="imagem/*" placeholder="Envie uma image">
                    </div>
                    <button name="editar" type="submit" class="btn btn-primary">editar</button>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('./footer.php'); ?>