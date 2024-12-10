<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: /project/views/login.php");
    exit();
}
require_once("C:/xampp/htdocs/project/controller/VendaController.php");

$ProdutosCont = new VendaController();
$List = $ProdutosCont->ObterVendaPorIdUsu($_SESSION['usuario_logado']['usu_id']);

include_once('head.php');
?>

<body class="bg-light">
    <!-- Topbar -->
    <?php include_once('menu.php') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column align-items-center w-100">
        <div class="border-radius w-75 m-5 align-middle">
            <div class="border-radius fundo_thead flex-row w-100">
                <?php
                // Agrupar produtos por código de venda
                $produtosAgrupados = [];
                foreach ($List as $produto) {
                    $produtosAgrupados[$produto['cod_venda']][] = $produto;
                }

                // Exibir cada grupo de produtos
                foreach ($produtosAgrupados as $codigoVenda => $produtos):
                ?>
                    <ul class="nav nav-tabs m-4 sem-borda-bottom p-2">
                        <li class="nav-item bg-light bg-orange sobrepor-container">
                            <p class="nav-link sem-edits-nav-link active bg-orange text-light" aria-current="page">Código do Pedido: <?= $codigoVenda ?>
                            </p>
                        </li>
                        <li class="nav-item bg-transparent  sobrepor-container">
                            <p class="nav-link sem-edits-nav-link active text-dark" aria-current="page"><?= date("d/m/Y", strtotime($produto['ven_dt'])); ?></p>
                        </li>
                        <li class="w-100 border-b-r bg-orange shadow p-3 mb-5 bg-body">
                            <?php foreach ($produtos as $produto): ?>
                                <div class="d-flex m-2 border-radius bg-orange-dark">
                                    <div class="flex-shrink-0">
                                    <?php
                                    $image_path = "../public/img/uploads/" .$produto['prod_imagem'];
                                        if(file_exists($image_path)){
                                            ?><img src="../public/img/uploads/<?= $produto['prod_imagem'] ?>" style="width: 100px;" class="border-radius"><?php
                                        } else {
                                            ?><img src="../public/img/default.webp" style="width: 100px;" class="border-radius"><?php
                                        }

                                    ?>
                                    </div>
                                    <div class="flex-grow-1 mx-2 d-flex align-items-start justify-content-md-center flex-column">
                                        <p class="text-light"><?= $produto['prod_nome'] ?></p>
                                        <p class="text-light">R$ <?= number_format($produto['ven_valor'], 2, ',', '.') ?></p>
                                    </div>
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-md-center">
                                       <p class="text-light mx-5 fs-6"></p>
                                    </div>
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-md-center">
                                        <p class="text-light mx-5">Quantidade: <?= $produto['ven_quantidade'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </li>
                    </ul>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>