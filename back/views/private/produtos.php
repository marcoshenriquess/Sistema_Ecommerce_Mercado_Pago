<?php

require_once("C:/xampp/htdocs/project/back/controller/produtoController.php");
$ProdutosCont = new ProdutoControll();
$List = $ProdutosCont->ListaProdutoControll();

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
            <table class="table">
                <thead>
                    <tr >
                        <th scope="col">Nome</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço de Custo</th>
                        <th scope="col">Preço de Venda</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col" colspan="2" class="align-text-bottom">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($List as $produto): ?>
                        <tr>
                            <th><?= $produto['nome_prod'] ?></th>
                            <td><?= $produto['tipo_prod_nome'] ?></td>
                            <td><?= $produto['descricao'] ?></td>
                            <td><?= $produto['preco_custo'] ?></td>
                            <td><?= $produto['preco_venda'] ?></td>
                            <td><?= $produto['vendedor_nome'] ?></td>
                            <td><a class="btn btn-secondary" href="editar-produto.php?id=<?= $produto['id_produto'] ?>">Editar</a></td>
                            <td>
                                <form action="excluir-produto.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $produto['id_produto'] ?>">
                                    <input type="submit" class="btn btn-danger" value="Excluir">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- END CONTEUDO -->

        <?php include_once('./footer.php');      ?>