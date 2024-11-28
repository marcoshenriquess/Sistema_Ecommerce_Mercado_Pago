<?php

// include('C:/xampp/htdocs/project/models/permissao.php');

require_once("../controller/produtoController.php");

$AuxListProd = new ProdutoControll();
$prod = $AuxListProd->ObterProdutoControll($_GET['id']);




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
                                <img class="card-img-top mb-5 mb-md-0" src="../public/img/uploads/<?= $prod['prod_imagem'] ?>" alt="..." />
                            </div>
                            <div class="col-md-6">
                                <h1 class="display-5 fw-bolder"><?= $prod['prod_nome'] ?></h1>
                                <div class="fs-5 mb-5">
                                    <?php if ($prod['prod_desconto'] > 0) { ?>
                                        <sup>
                                            <p class="txt-gray fs-6 line m-0">R$ <?= $prod['prod_venda'] ?></p>
                                        </sup>
                                        <?php
                                        $ValorDesconto = ($prod['prod_desconto'] / 100) * $prod['prod_venda'];
                                        $Result = $prod['prod_venda'] - $ValorDesconto;
                                        $ValorComDesconto = number_format($Result, 2, ',', '.');
                                        ?>
                                        <p class="txt-black fs-1">R$ <?= $ValorComDesconto ?></p>
                                    <?php } else { ?>

                                        <p class="txt-black fs-1 ">R$ <?= $prod['prod_venda'] ?></p>
                                    <?php } ?>
                                </div>
                                <p class="lead"><?= $prod['prod_descricao'] ?></p>
                                <div class="d-flex">
                                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                        <i class="bi-cart-fill me-1"></i>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Related items section-->
                <section class="py-5 bg-light">
                    <div class="container px-4 px-lg-5 mt-5">
                        <h2 class="fw-bolder mb-4">Related products</h2>
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Fancy Product</h5>
                                            <!-- Product price-->
                                            $40.00 - $80.00
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                    <!-- Product image-->
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                    <!-- Product image-->
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Sale Item</h5>
                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">$50.00</span>
                                            $25.00
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Popular Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            $40.00
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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