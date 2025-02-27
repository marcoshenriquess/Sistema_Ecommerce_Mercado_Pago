<?php

require_once("../../models/permissao.php");


Verificar_Permissão_Pag();


require_once("C:/xampp/htdocs/project/controller/VendaController.php");
require_once("../../controller/CategoriaPaiController.php");

$AuxControllPai = new CategoriaPaiController();
$VendaControll = new VendaController();

$CodVenda = null;
$NomeCliente = "";
$ordPor = 0;
$catPai = null;
$catFilho = null;


$CategoriaPai = $AuxControllPai->ListaCategorias();

if (isset($_POST['buscar'])) {
    if (isset($_POST['codVenda']) ){
        $CodVenda = $_POST['codVenda'];
    }
    if (isset($_POST['NomeCliente']) ){
        $NomeCliente = $_POST['NomeCliente'];
    }
    if (isset($_POST['ordPor'])){
        $ordPor = $_POST['ordPor'];
    }
    if (isset($_POST['catPai'])){
        $catPai = $_POST['catPai'];
    }
    if (isset($_POST['catFilho'])){
        $catFilho = $_POST['catFilho'];
    }
    $List = $VendaControll->FiltragemVenda($CodVenda, $NomeCliente, $ordPor, $catPai , $catFilho);
} else {
    $List = $VendaControll->ObterAllVenda();
}



$MaxPag = count($List);
$TotalPags = $MaxPag / 8;
if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
} else {
    $pagina = 0;
}

// $List = $VendaControll->ObterPagVenda($pagina);

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
            <fieldset class="w-100 d-flex mb-3">
                <legend>Vendas</legend>
                <form class="w-100 d-flex justify-content-start align-itens-center" method="POST">
                    <div class="input-group d-flex d-flex justify-content-md-center align-itens-center">
                        <input type="number" id="codVenda" name="codVenda" class="form-control shadow-sm rounded" placeholder="Pesquisar pelo código"
                            aria-label="Search" aria-describedby="basic-addon2" style="height: 38px;">
                    </div>
                    <div class="input-group d-flex d-flex justify-content-md-center align-itens-center ml-3">
                        <input type="text" id="NomeCliente" name="NomeCliente" class="form-control shadow-sm rounded" placeholder="Pesquisar pelo cliente"
                            aria-label="Search" aria-describedby="basic-addon2" style="height: 38px;">
                    </div>
                    <div class="input-group d-flex ml-3 d-flex justify-content-md-center align-itens-center">
                        <select id="ordPor" name="ordPor" class="form-control shadow-sm" aria-label=".form-control-sm example">
                            <option disabled selected>Ordenar por...</option>
                            <option value="1">Valor Crescente</option>
                            <option value="2">Valor Decrescente</option>
                            <option value="3">Cliente de A-Z</option>
                            <option value="4">Cliente de Z-A</option>
                            <option value="5">Data Crescente</option>
                            <option value="6">Data Decrescente</option>
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
            <p>Total de vendas: <?=count($List) ?></p>
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
                        <?php foreach ($List as $venda): ?>
                            <tr>
                                <th><?= $venda['cod_venda'] ?></th>
                                <th><?= $venda['usu_nome'] ?></th>
                                <td style="max-width: 15ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= $venda['prod_nome'] ?></td>
                                <td><?= $venda['ven_quantidade'] ?></td>
                                <td>R$ &nbsp;<?php echo number_format($venda['ven_valor'], 2, ',', '.') ?></td>
                                <td><?= $venda['ven_dt'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else {
                echo "<div class='w-100 d-flex justify-content-md-center align-itens-center'><p>Nenhuma Venda Feita</p></div> ";
            } ?>

            <div class="d-flex justify-content-md-center align-items-center mt-2 p-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <?php if ($pagina > 0) { ?>
                            <li class="page-item"><a class="page-link text-white bg-primary" href="?pagina=<?= $pagina - 1 ?>">Voltar</a></li>
                        <?php } else { ?>
                            <li class="page-item disabled"><a class="page-link" href="?pagina=<?= $pagina - 1 ?>">Voltar</a></li>
                        <?php } ?>

                        <li class="page-item">
                            <p class="page-link"><?= $pagina ?></p>
                        </li>

                        <?php if ($pagina + 1 < $TotalPags) { ?>
                            <li class="page-item"><a class="page-link text-white bg-primary" href="?pagina=<?= $pagina + 1 ?>">Proximo</a></li>
                        <?php } else { ?>
                            <li class="page-item disabled"><a class="page-link" href="?pagina=<?= $pagina + 1 ?>">Proximo</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- END CONTEUDO -->

        <?php include_once('./footer.php');      ?>