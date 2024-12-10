<?php

include_once("../../models/permissao.php");

require_once("C:/xampp/htdocs/project/controller/produtoController.php");

$ProdutosCont = new ProdutoControll();
$Prods_get = $ProdutosCont->ListaAllProduto();

$MaxPag = count($Prods_get);
$TotalPags = $MaxPag / 8;

if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
} else {
    $pagina = 0;
}
$ProdutosCont = new ProdutoControll();
$List = $ProdutosCont->ListaProdutoControll($pagina);

if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
} else {
    $pagina = 0;
}


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
            <table class="table table-borderless shadow border-radius p-5 align-middle">
                <thead class="border-radius fundo_thead">
                    <tr class="fundo_thead">
                        <th scope="col" style="width: 300px;">Nome</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Custo</th>
                        <th scope="col">Venda</th>
                        <th scope="col" colspan="2" class="align-text-bottom">Ações</th>
                    </tr>
                </thead>
                <tbody class="m-2">
                    <?php foreach ($List as $produto): ?>
                        <tr class="border <?= $produto['prod_quantidade'] <= 0 ? 'bg-danger-white text-dark' : 'text-dark ', $produto['prod_quantidade'] <= 3 ? 'bg-warning text-dark' : '' ?>">
                            <th style="max-width: 15ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= $produto['prod_nome'] ?></th>
                            <td><?= $produto['tipo_prod_nome'] ?></td>
                            <td class=" <?= $produto['prod_quantidade'] <= 3 ? 'text-danger' : 'text-dark  font-wight-bolt' ?>"><?= $produto['prod_quantidade'] ?></td>
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