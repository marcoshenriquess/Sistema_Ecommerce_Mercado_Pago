<?php

// include('C:/xampp/htdocs/project/models/permissao.php');

require_once("../controller/produtoController.php");


$AuxListProd = new ProdutoControll();
$ListProd = $AuxListProd->ListaProdutoControll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../public/css/sb-admin-2.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="w-100">

            <!-- Topbar -->
            <?php include_once('header.php') ?>
            <!-- End of Topbar -->

            <!--CONTEUDO -->

            <div class="w-100">
                <div class="row justify-content-md-center  w-100">
                    <?php foreach ($ListProd as $prod): ?>
                            <div class="card m-5 shadow-lg rounded d-flex flex-column bd-highlight" style="width: 23rem; height: auto; min-height: 480px;">
                                <div>
                                    <?php if ($prod['prod_desconto'] > 0) { ?>
                                        <span class="badge bg-danger m-3 p-2 zindex-fixed txt-white">-<?= $prod['prod_desconto'] ?>% OFF</span>
                                    <?php } ?>
                                    <img src="../public/img/uploads/<?= $prod['prod_imagem'] ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <div>
                                    <p class="card-title txt-black"><?= $prod['prod_nome'] ?></p>
                                    </div>
                                    <div>
                                    
                                        <?php if ($prod['prod_desconto'] > 0) { ?>
                                            <sup><p class="txt-gray fs-6 line m-0">R$ <?= $prod['prod_venda'] ?></p></sup>
                                            <?php
                                            $ValorDesconto = ($prod['prod_desconto'] / 100) * $prod['prod_venda'];
                                            $Result = $prod['prod_venda'] - $ValorDesconto;
                                            $ValorComDesconto = number_format($Result, 2, ',', '.');
                                            ?>
                                            <p class="txt-black fs-3">R$ <?= $ValorComDesconto ?></p>
                                        <?php } else { ?>

                                            <p class="txt-black fs-3 ">R$ <?= $prod['prod_venda'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <a href="view-produto.php?id=<?= $prod['prod_id'] ?>" class="btn btn-primary p-2 w-100">Ver</a>
                                    </div>
                                </div>
                                <!-- 
                                <div class="card-body">
                                    
                                    <p class="card-text"><?= $prod['prod_venda'] ?></p>
                                    <a href="#" class="btn btn-primary">Ver</a>
                                </div> -->
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- /.container-fluid -->



            <!-- Bootstrap core JavaScript-->
            <script src="C:/xampp/htdocs/project/public/vendor/jquery/jquery.min.js"></script>
            <script src="C:/xampp/htdocs/project/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="C:/xampp/htdocs/project/public/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="C:/xampp/htdocs/project/public/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="C:/xampp/htdocs/project/public/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="C:/xampp/htdocs/project/public/js/demo/chart-area-demo.js"></script>
            <script src="C:/xampp/htdocs/project/public/js/demo/chart-pie-demo.js"></script>

</body>

</html>