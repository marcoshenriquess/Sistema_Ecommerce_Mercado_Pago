<?php
require_once(dirname(__DIR__) . "/controller/produtoController.php");
require_once(dirname(__DIR__) . "/models/produto.php");
require_once(dirname(__DIR__) . "/controller/produtoController.php");


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ENVIANDO ITEM PARA O CARRINHO
if (isset($_GET["id"])) { // O $_GET['ID'] PEGA O ID DO PRODUTO QUE ESTÁ SENDO ENVIADO POR UMA REQUISIÇÃO
    
    // BUSCANDO O PRODUTO DE ACORDO COM AQUELE ID
    $produtoContr = new ProdutoControll();
    $prod = $produtoContr->ObterProdutoControll($_GET['id']);
    if ($prod['prod_quantidade'] > 0) {
        // PEGANDO O ID DO ARRAY[PRODUTOS] E ARMAZENANDO EM UMA VARIÁVEL
        $produtoId = $prod['prod_id'];
        if (!isset($_SESSION['carrinho'])) { // DEFININDO O CARRINHO COMO VAZIO
            $_SESSION['carrinho'] = [];
        }

        // VERIFICAR SE O CARRINHO JÁ EXISTE NO CARRINHO
        $inCar = false; // ATRIBUINDO FALSE A VARÁVEL inCar PARA SABERMOS SE ESTÁ NO CARRINHO OU NÃO
        foreach ($_SESSION['carrinho'] as $item) { // PERCORRENDO PELO CARRINHO PARA BUSCAR VER SE O ITEM EXISTE
            if ($item['prod_id'] == $produtoId) { // SE ELE ENCONTRAR, VAI ATRIBUIR TRUE PARA O inCar, INDICANDO QUE HÁ UM PRODUTO IGUAL NO CARRINHO
                $inCar = true;
                break; // BREAK É USADO PARA SAIR DO LOOP QUANDO É ENCONTRADO O PRODUTO!
            }
        }
        if (!$inCar) { // SE O PRODUTO NÃO ESTIVER NO CARRINHO ELE VAI SER ADICIONADO
            $_SESSION['carrinho'][] = $prod;
        }
        header('Location: index.php');
    }
}

// LISTANDO OS PRODUTOS EXISTENTES ARMAZENADO
$AuxListProd = new ProdutoControll();
$ListProd = $AuxListProd->ListaProdutoControll();

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
                <div class="row justify-content-md-center  w-100">
                    <?php foreach ($ListProd as $prod): ?><!-- Loop para listar todos os produtos -->
                        <div class="card m-5 shadow-lg rounded d-flex flex-column bd-highlight" style="width: 18rem; height: auto; min-height: 480px;">
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
                                <div class="card-body">
                                    <form method="GET" action="index.php?id=">
                                        <input type="hidden" name="id" value="<?= $prod['prod_id'] ?>">
                                        <?php if ($prod['prod_quantidade'] > 0){?>
                                            <a onclick="AddCarrinho(<?= $prod['prod_id'] ?>)"><button type="submit" id="AddCarrinho" class="btn btn-primary p-2 w-100">Adicionar ao Carrinho</button></a>
                                        <?php } else { ?>
                                            <div class="alert alert-danger d-flex justify-content-md-center align-items-center p-2 w-100" role="alert"><div class="fs-5 text-center">PRODUTO INDISPONÍVEL</div></div>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
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