<?php

require_once("../../models/permissao.php");


Verificar_Permissão_Pag();


require_once("C:/xampp/htdocs/project/controller/VendaController.php");
$UsuarioCont = new VendaController();
$List = $UsuarioCont->ObterAllVenda();



$MaxPag = count($List);
$TotalPags = $MaxPag / 8;

if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
} else {
    $pagina = 0;
}

$List = $UsuarioCont->ObterPagVenda($pagina);

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
                <div class="d-none w-100 mb-3">

                </div>
                <div class="d-sm-flex align-items-center justify-content-end w-100 mb-3">
                    <a href="relatorio.php?id=2" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Relatório de Vendas</a>
                </div>
            </div>
            <?php if ($List) { ?>
                <table class="table table-hover shadow border-radius p-5 align-middle border-top-none">
                    <thead class="border-radius fundo_thead">
                        <tr class="fundo_thead">
                            <th class="w-auto" scope="col">Codigo</th>
                            <th style="width: 300px;" scope="col">Cliente</th>
                            <th scope="col">Produtos</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody class="m-2">
                        <?php foreach ($List as $usuario): ?>
                            <tr>
                                <th><?= $usuario['cod_venda'] ?></th>
                                <th><?= $usuario['usu_nome'] ?></th>
                                <td style="max-width: 15ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= $usuario['prod_nome'] ?></td>
                                <td><?= $usuario['ven_quantidade'] ?></td>
                                <td>R$ &nbsp;<?php
                                                $Total = $usuario['ven_valor'] * $usuario['ven_quantidade'];
                                                echo number_format($Total, 2, ',', '.')
                                                ?></td>
                                <td><?= $usuario['ven_dt'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { echo "<div class='w-100 d-flex justify-content-md-center align-itens-center'><p>Nenhuma Venda Feita</p></div> "; } ?>

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