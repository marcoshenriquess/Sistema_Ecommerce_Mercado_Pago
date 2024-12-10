<?php

// include('C:/xampp/htdocs/project/models/permissao.php');

require_once("../controller/produtoController.php");

$AuxListProd = new ProdutoControll();
$prod = $AuxListProd->ObterProdutoControll($_GET['id']);
$ListProd = $AuxListProd->ItemsAleatorios();


include_once('head.php');
?>

<body class="bg-light">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="w-100">

            <!-- Topbar -->
            <?php include_once('menu.php') ?>
            <!-- End of Topbar -->

            <!--CONTEUDO -->

            <div class="w-100">
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6">
                                <?php if ($prod['prod_desconto'] > 0) { ?>
                                    <span class="badge bg-danger m-3 p-2 zindex-fixed txt-white">-<?= $prod['prod_desconto'] ?>% OFF</span>
                                <?php } ?>
                                
                                <?php
                                    $image_path = "../public/img/uploads/" .$prod['prod_imagem'];
                                        if(file_exists($image_path)){
                                            ?><img src="../public/img/uploads/<?= $prod['prod_imagem'] ?>" class="card-img-top" ><?php
                                        } else {
                                            ?><img src="../public/img/default.webp" class="card-img-top" ><?php
                                        }

                                    ?>
                            </div>
                            <div class="col-md-6">
                                <h1 class="display-5 fw-bolder"><?= $prod['prod_nome'] ?></h1>
                                <div class="p-2">
                                    <div>
                                        <?php $ValorTotal = 0;
                                        if ($prod['prod_desconto'] > 0) { ?>
                                            <sup>
                                                <p class="txt-gray fs-6 line m-0">R$ <?= $prod['prod_venda'] ?></p>
                                            </sup>
                                            <?php
                                            $ValorDesconto = ($prod['prod_desconto'] / 100) * $prod['prod_venda'];
                                            $Result = $prod['prod_venda'] - $ValorDesconto;
                                            $ValorComDescoto = number_format($Result, 2, '.', ',');
                                            $prod['ValorDe'] = $ValorComDescoto;
                                            ?>
                                            <p class="txt-black fs-3">R$ <?= $prod['ValorDe'] ?></p>
                                        <?php } else { ?>

                                            <p class="txt-black fs-3 ">R$ <?= $prod['prod_venda'] ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <p class="lead"><?= $prod['prod_descricao'] ?></p>
                                <form class="h-auto" method="GET" action="index.php?id=">
                                    <input type="hidden" name="id" value="<?= $prod['prod_id'] ?>">
                                    <?php if ($prod['prod_quantidade'] > 0) { ?>
                                        <a onclick="AddCarrinho(<?= $prod['prod_id'] ?>)"><button type="submit"
                                                id="AddCarrinho" class="btn btn-warning p-2 w-100 ">Adicionar ao
                                                Carrinho</button></a>
                                    <?php } else { ?>
                                        <div class="btn btn-danger p-2 w-100" role="alert">
                                            <div class="fs-5 text-center">PRODUTO INDISPONÍVEL</div>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Related items section-->
                <section class="py-5 bg-light">
                    <div class="ajuste-heigth-box text-center">
                        <h2 class="mb-5">Related products</h2>
                        <div class="row ajuste-flex-cards">
                            <?php foreach ($ListProd as $item): ?>
                                <div class="card shadow rounded ajuste-card-item ajuste-flex-boxs">
                                    <div>
                                        <?php if ($item['prod_desconto'] > 0) { ?>
                                            <span class="badge bg-danger m-3 p-2 zindex-fixed txt-white">-<?= $item['prod_desconto'] ?>%
                                                OFF</span>
                                        <?php } ?>
                                
                                        <?php
                                            $image_path = "../public/img/uploads/" .$item['prod_imagem'];
                                                if(file_exists($image_path)){
                                                    ?><img src="../public/img/uploads/<?= $item['prod_imagem'] ?>" class="card-img-top" ><?php
                                                } else {
                                                    ?><img src="../public/img/default.webp" class="card-img-top" ><?php
                                                }

                                        ?>
                                    </div>
                                    <div class="card-body p-2 ajuste-flex-boxs">
                                        <div class="p-2">
                                            <div>
                                                <p class="card-title txt-black"><?= $item['prod_nome'] ?></p>
                                            </div>
                                            <div>
                                                <?php $ValorTotal = 0;
                                                if ($item['prod_desconto'] > 0) { ?>
                                                    <sup>
                                                        <p class="txt-gray fs-6 line m-0">R$ <?= $item['prod_venda'] ?></p>
                                                    </sup>
                                                    <?php
                                                    $ValorDesconto = ($item['prod_desconto'] / 100) * $item['prod_venda'];
                                                    $Result = $item['prod_venda'] - $ValorDesconto;
                                                    $ValorComDescoto = number_format($Result, 2, '.', ',');
                                                    $item['ValorDe'] = $ValorComDescoto;
                                                    ?>
                                                    <p class="txt-black fs-3">R$ <?= $item['ValorDe'] ?></p>
                                                <?php } else { ?>

                                                    <p class="txt-black fs-3 ">R$ <?= $item['prod_venda'] ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class=" mt-5">
                                            <div class="d-flex justify-content-md-center align-items-center w-100">
                                                <a class="btn btn-outline-secondary mb-2 d-flex justify-content-md-center align-items-center w-100"
                                                    style="height: 40px;" href="view-produto.php?id=<?= $item['prod_id'] ?>">Ver</a>
                                            </div>
                                            <form class="h-auto" method="GET" action="index.php?id=">
                                                <input type="hidden" name="id" value="<?= $item['prod_id'] ?>">
                                                <?php if ($item['prod_quantidade'] > 0) { ?>
                                                    <a onclick="AddCarrinho(<?= $item['prod_id'] ?>)"><button type="submit"
                                                            id="AddCarrinho" class="btn btn-warning p-2 w-100 ">Adicionar ao
                                                            Carrinho</button></a>
                                                <?php } else { ?>
                                                    <div class="btn btn-danger p-2 w-100" role="alert">
                                                        <div class="fs-5 text-center">PRODUTO INDISPONÍVEL</div>
                                                    </div>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Adicionar no localStorage o produto -->
            <script>
                function AddCarrinho(id) {
                    var value = parseInt(localStorage.getItem('quantidade_' + id));
                    var cont = value;
                    if (value > 0) {
                        let total = cont += 1;
                        localStorage.setItem('quantidade_' + id, total);
                    } else {
                        localStorage.setItem('quantidade_' + id, 1);
                    }
                }
            </script>
</body>

</html>