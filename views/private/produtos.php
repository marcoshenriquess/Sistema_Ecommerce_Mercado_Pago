<?php

include_once("../../models/permissao.php");

require_once("C:/xampp/htdocs/project/controller/produtoController.php");

if($_SESSION['tipo_user'] == 1){
    $ProdutosCont = new ProdutoControll();
    $List = $ProdutosCont->ListaProdutoControll();
} else {
    $ProdutosCont = new ProdutoControll();
    $List = $ProdutosCont->ListaProdutoPorID($_SESSION['usuario_logado']['usu_id']);
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
            <div class="w-100 m-3">
                <a class="btn btn-primary" href="cadastrar-produto.php">Cadastrar novo protudo</a>
            </div>
            <div class="w-100 m-3 d-flex">
                <div class="bg-danger-white m-2" style="width: 20px; height: 20px;"></div><p class="m-2">Produtos sem estoque</p>
            </div>
            <table class="table table-borderless shadow border-radius p-5 align-middle">
                <thead class="border-radius fundo_thead">
                    <tr class="fundo_thead">
                        <th scope="col">Nome</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Custo</th>
                        <th scope="col">Venda</th>
                        <th scope="col" colspan="2" class="align-text-bottom">Ações</th>
                    </tr>
                </thead>
                <tbody class="m-2">
                    <?php foreach ($List as $produto): ?>
                        <tr class="border <?= $produto['prod_quantidade'] <= 0 ? 'bg-danger-white text-dark' : 'text-dark ' ?>">
                            <th><?= $produto['prod_nome'] ?></th>   
                            <td><?= $produto['tipo_prod_nome'] ?></td>
                            <td class=" <?= $produto['prod_quantidade'] <= 0 ? 'text-danger' : 'text-dark  font-wight-bolt' ?>"><?= $produto['prod_quantidade'] ?></td>
                            <td><?= $produto['prod_custo'] ?></td>
                            <td><?= $produto['prod_venda'] ?></td>
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
        </div>

        <!-- END CONTEUDO -->

        <?php include_once('./footer.php');      ?>