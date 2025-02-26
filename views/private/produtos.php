<?php

include_once("../../models/permissao.php");

require_once("C:/xampp/htdocs/project/controller/produtoController.php");
require_once("../../controller/CategoriaPaiController.php");

$AuxControllPai = new CategoriaPaiController();
$CategoriaPai = $AuxControllPai->ListaCategorias();

$nomeProd = "";
$ordPor = 0;
$catPai = null;
$catFilho = null;

if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
} else {
    $pagina = 0;
}
// print_r($List);
if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
} else {
    $pagina = 0;
}

if (isset($_POST['buscar'])) {
    if (isset($_POST['produtosId'])) {
        $nomeProd = $_POST['produtosId'];
    }
    if (isset($_POST['catPai'])) {
        $catPai = $_POST['catPai'];
    }
    if (isset($_POST['catFilho'])) {
        $catFilho = $_POST['catFilho'];
    }
    if (isset($_POST['ordPor'])) {
        $ordPor = $_POST['ordPor'];
    }

    $ProdutosCont = new ProdutoControll();
    $Prods_get = $ProdutosCont->ProdutosFiltrados($nomeProd, $ordPor, $catPai, $catFilho);
    $List = $Prods_get;
} else {
    $ProdutosCont = new ProdutoControll();
    $Prods_get = $ProdutosCont->ListaAllProduto();
    $List = $ProdutosCont->ListaProdutoControll($pagina);
}
$MaxPag = count($Prods_get);
$TotalPags = $MaxPag / 8;


?>




<!-- Sidebar -->
<?php include_once('menu.php') ?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper">
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include_once('header.php') ?>
        <!-- End of Topbar -->

        <!--CONTEUDO -->
        <div class="w-100 p-3 h-100 ">
            <div class="d-flex justify-content-md-center align-items-center w-100">
                <div class="w-100 mb-3">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="cadastrar-produto.php">Cadastrar novo protudo</a>
                </div>
                <div class="d-sm-flex align-items-center justify-content-end w-100 mb-3">
                    <a href="export-file.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Exportar Arquivo CSV</a>
                    <a href="relatorio.php?id=1" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm m-1"><i
                            class="fas fa-download fa-sm text-white-50"></i> Relatório de Produtos</a>
                </div>
            </div>
            <fieldset class="w-100 d-flex mb-3">
                <legend>Produtos</legend>
                <form class="w-100 d-flex justify-content-start align-itens-center" method="POST">
                    <div class="input-group d-flex d-flex justify-content-md-center align-itens-center">
                        <input type="text" id="produtosId" name="produtosId" class="form-control shadow-sm rounded" placeholder="Pesquisar pelo nome"
                            aria-label="Search" aria-describedby="basic-addon2" style="height: 38px;">

                        <ul id="produtoList" class="produtoList list-group mt-5" style="display: none; position: absolute; z-index: 1000; width: 100%; height: auto; max-height: 500px;">
                            <!-- A lista de pastas será preenchida aqui -->
                        </ul>
                    </div>
                    <div class="input-group d-flex ml-3 d-flex justify-content-md-center align-itens-center">
                        <select id="ordPor" name="ordPor" class="form-control shadow-sm" aria-label=".form-control-sm example">
                            <option disabled selected>Ordenar por...</option>
                            <option value="1">Preço Crescente</option>
                            <option value="2">Preço Decrescente</option>
                            <option value="3">de A-Z</option>
                            <option value="4">de Z-A</option>
                            <option value="5">Estoque Crescente</option>
                            <option value="6">Estoque Decrescente</option>
                        </select>
                    </div>
                    <div class="input-group d-flex ml-3 d-flex justify-content-md-center align-itens-center">
                        <select id="catPai" name="catPai" class="form-control shadow-sm" id="CategoriaPai" onchange="javascript:mostraCatFilho(this)" required>
                            <option selected disabled>Filtrar por categoria Pai</option>
                            <?php foreach ($CategoriaPai as $tipo): ?>
                                <option value="<?= $tipo['catPai_id'] ?>"><?= $tipo['catPai_nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group d-flex ml-3 d-flex justify-content-md-center align-itens-center">
                        <select id="catFilho" name="catFilho" class="form-control shadow-sm" id="CategoriaFilho" required disabled>
                            <option selected disabled>Filtrar por categoria Filho</option>
                        </select>
                    </div>
                    <div class="input-group w-25 d-flex ml-3 d-flex justify-content-md-center align-itens-center">
                        <button name="buscar" type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </fieldset>
            <table class="table table-borderless shadow border-radius p-5 align-middle">
                <thead class="border-radius fundo_thead">
                    <tr class="fundo_thead">
                        <th scope="col" style="width: 300px;">Nome</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Custo</th>
                        <th scope="col">Venda</th>
                        <th scope="col" colspan="2" class="align-text-bottom">Ações</th>
                    </tr>
                </thead>
                <tbody class="m-2">
                    <?php foreach ($List as $produto): ?>
                        <tr class="border <?= $produto['prod_estoque'] <= 0 ? 'bg-danger-white text-dark' : 'text-dark ', $produto['prod_estoque'] <= 3 ? 'bg-warning text-dark' : '' ?>">
                            <th style="max-width: 15ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= $produto['prod_nome'] ?></th>
                            <td><?= $produto['catPai_nome'] ?></td>
                            <td class=" <?= $produto['prod_estoque'] <= 3 ? 'text-danger' : 'text-dark  font-wight-bolt' ?>"><?= $produto['prod_estoque'] ?></td>
                            <td>R$ <?= $produto['prod_custo'] ?></td>
                            <td>R$ <?= $produto['prod_venda'] ?></td>
                            <td><a class="btn btn-secondary shadow" href="editar-produto.php?id=<?= $produto['prod_id'] ?>">Editar</a></td>
                            <td>
                                <form action="excluir-produto.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $produto['prod_id'] ?>">
                                    <input type="submit" class="btn btn-danger shadow" value="Excluir">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="w-100 m-3 d-flex">
                <div class="bg-danger-white m-2" style="width: 20px; height: 20px;"></div>
                <p class="m-2">Produtos sem estoque</p>
                <div class="bg-warning m-2" style="width: 20px; height: 20px;"></div>
                <p class="m-2">Produtos esgotando</p>
            </div>
            <div class="d-flex justify-content-md-center align-items-center mt-2 p-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <?php if ($pagina > 0) { ?>
                            <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina - 1 ?>">Voltar</a></li>
                        <?php } else { ?>
                            <li class="page-item disabled"><a class="page-link" href="?pagina=<?= $pagina - 1 ?>">Voltar</a></li>
                        <?php } ?>

                        <li class="page-item">
                            <p class="page-link"><?= $pagina ?></p>
                        </li>

                        <?php if ($pagina + 1 < $TotalPags) { ?>
                            <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina + 1 ?>">Proximo</a></li>
                        <?php } else { ?>
                            <li class="page-item disabled"><a class="page-link" href="?pagina=<?= $pagina + 1 ?>">Proximo</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- END CONTEUDO -->

        <?php include_once('./footer.php');      ?>