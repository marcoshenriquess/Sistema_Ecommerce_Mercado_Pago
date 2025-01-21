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
        header('Location: carrinho.php');
    }
}

// LISTANDO OS PRODUTOS EXISTENTES ARMAZENADO
$AuxListProd = new ProdutoControll();
$ListProd = $AuxListProd->ListaAllProduto();

include_once('head.php');
?>
<style>
    .dropdown-pers {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        /* hide by default */
    }

    .dropdown-pers:hover .dropdown-menu {
        display: block;
        position: absolute;
        z-index: 1000;
        display: flex !important;
        justify-content: space-between;
    }

    .fa-sort-up {
        margin-top: 10px;
    }

    .dropdown-pers:hover .fa-sort-up {
        transform: rotate(180deg);
        margin-top: 0px;
        margin-bottom: 5px;
    }
</style>

<body class="bg-light">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content" class="w-100">
            <!-- Topbar -->
            <?php include_once('menu.php') ?>
            <!-- End of Topbar -->
            
                <div class="w-100" style="height: 50px;">
                    <ul class="row navbar-nav m-1 edit-menu-produtos h-100">
                        <div class="dropdown-pers">
                            <a style="font-size: 13px;"
                                class="nav-link active hover-color-gray text-menu-secondary d-flex justify-content-md-center align-items-center"
                                aria-current="page" aria-labelledby="searchDropdown">
                                Todas as Categorias
                                <i class="fas fa-sort-up ml-3 "></i>
                            </a>
                            <ul class="dropdown-menu shadow animated--grow-in p-3" aria-labelledby="searchDropdown">
                                <li class="m-2 mr-5">
                                    <p><small>Futebol</small></p>
                                    <a class="dropdown-item" href="#">Camisetas de time</a>
                                    <a class="dropdown-item" href="#">Camisetas</a>
                                    <a class="dropdown-item" href="#">Blusas</a>
                                    <a class="dropdown-item" href="#">Acessórios</a>
                                    <a class="dropdown-item" href="#">Equipamentos</a>
                                    <a class="dropdown-item" href="#">Calçados</a>
                                    <a class="dropdown-item" href="#">Bonés</a>
                                    <a class="dropdown-item" href="#">Meias</a>
                                    <a class="dropdown-item" href="#">Luvas</a>
                                    <div class="dropdown-divider mt-5"></div>
                                    <p><small>Basquete</small></p>
                                    <a class="dropdown-item" href="#">Regatas de time</a>
                                    <a class="dropdown-item" href="#">Camisetas</a>
                                    <a class="dropdown-item" href="#">Blusas</a>
                                    <a class="dropdown-item" href="#">Acessórios</a>
                                    <a class="dropdown-item" href="#">Equipamentos</a>
                                    <a class="dropdown-item" href="#">Calçados</a>
                                    <a class="dropdown-item" href="#">Bonés</a>
                                    <a class="dropdown-item" href="#">Meias</a>
                                    <a class="dropdown-item" href="#">Luvas</a>
                                </li>
                                <li class="m-2 mr-5">
                                    <p><small>Acampamento</small></p>
                                    <a class="dropdown-item" href="#">Barracas</a>
                                    <a class="dropdown-item" href="#">Colchonetes</a>
                                    <a class="dropdown-item" href="#">Acessórios</a>
                                    <a class="dropdown-item" href="#">Bolsas</a>
                                    <a class="dropdown-item" href="#">Calçados</a>
                                    <a class="dropdown-item" href="#">Bonés</a>
                                    <a class="dropdown-item" href="#">Roupas</a>
                                    <a class="dropdown-item" href="#">Suplementos</a>
                                    <div class="dropdown-divider mt-5"></div>
                                    <p><small>Academia</small></p>
                                    <a class="dropdown-item" href="#">Pesos</a>
                                    <a class="dropdown-item" href="#">Colchonetes</a>
                                    <a class="dropdown-item" href="#">Bancos</a>
                                    <a class="dropdown-item" href="#">Acessórios</a>
                                    <a class="dropdown-item" href="#">Calçados</a>
                                    <a class="dropdown-item" href="#">Bonés</a>
                                    <a class="dropdown-item" href="#">Roupas</a>
                                </li>
                                <li class="m-2">
                                    <p><small>Academia</small></p>
                                    <a class="dropdown-item" href="#">Pesos</a>
                                    <a class="dropdown-item" href="#">Colchonetes</a>
                                    <a class="dropdown-item" href="#">Bancos</a>
                                    <a class="dropdown-item" href="#">Acessórios</a>
                                    <a class="dropdown-item" href="#">Calçados</a>
                                    <a class="dropdown-item" href="#">Bonés</a>
                                    <a class="dropdown-item" href="#">Roupas</a>
                                </li>
                            </ul>
                        </div>
                        <div class=""
                            style="height: 20px; border-right: 1px solid rgba(133, 133, 133, 0.10) !important;"></div>
                        <li class="nav-item d-flex justify-content-md-center align-items-center"
                            style="list-style-type: none;"><a style="font-size: 13px;"
                                class="nav-link active hover-color-gray text-menu-secondary" aria-current="page"
                                href="index.php">Produtos Femininos</a></li>
                        <div class=""
                            style="height: 20px; border-right: 1px solid rgba(133, 133, 133, 0.10) !important;"></div>
                        <li class="nav-item d-flex justify-content-md-center align-items-center"
                            style="list-style-type: none;"><a style="font-size: 13px;"
                                class="nav-link active hover-color-gray text-menu-secondary" aria-current="page"
                                href="index.php">Calçados</a></li>
                        <div class=""
                            style="height: 20px; border-right: 1px solid rgba(133, 133, 133, 0.10) !important;"></div>
                        <li class="nav-item d-flex justify-content-md-center align-items-center"
                            style="list-style-type: none;"><a style="font-size: 13px;"
                                class="nav-link active hover-color-gray text-menu-secondary" aria-current="page"
                                href="index.php">SportStyle</a></li>
                        <div class=""
                            style="height: 20px; border-right: 1px solid rgba(133, 133, 133, 0.10) !important;"></div>
                        <li class="nav-item d-flex justify-content-md-center align-items-center"
                            style="list-style-type: none;"><a style="font-size: 13px;"
                                class="nav-link active hover-color-gray text-menu-secondary" aria-current="page"
                                href="index.php">Basquete</a></li>
                        <div class=""
                            style="height: 20px ; border-right: 1px solid rgba(133, 133, 133, 0.10) !important;"></div>
                        <li class="nav-item d-flex justify-content-md-center align-items-center"
                            style="list-style-type: none;"><a style="font-size: 13px;"
                                class="nav-link active hover-color-gray text-menu-secondary" aria-current="page"
                                href="index.php">Futebol</a></li>
                    </ul>
                </div>
                <div class="w-100 ajust-img-fundo" style="height:700px;">
                    <div class="w-100 h-100 bg-black-opacity">
                        <div class="h-100 d-flex justify-content-md-center align-items-start flex-column"
                            style="font-size:50px;">
                            <p class="ml-5 txt-white">CONFIRA <br> AS MAIS NOVAS <br>CAMISETAS DO <br>REAL MADRID</p>
                            <a href="#" class="ml-5 txt-white btn btn-danger-personalizado" style="width: 10%;">Ver</a>
                        </div>
                    </div>
                </div>
                <!--CONTEUDO -->
                <main class="w-100 mt-5">
                    <article class="row justify-content-md-center p-3 w-100">
                        <?php foreach ($ListProd as $prod): ?>
                            <!-- Loop para listar todos os produtos -->
                            <div class="card m-1 rounded ajuste-card-item ajuste-flex-boxs">
                                <div>
                                    <?php if ($prod['prod_desconto'] > 0) { ?>
                                        <span
                                            class="badge bg-danger m-3 p-2 zindex-fixed txt-white">-<?= $prod['prod_desconto'] ?>%
                                            OFF</span>
                                    <?php } ?>

                                    <?php
                                    $image_path = "../public/img/uploads/" . $prod['prod_imagem'];
                                    if (file_exists($image_path)) {
                                    ?> <img src="../public/img/uploads/<?= $prod['prod_imagem'] ?>"
                                            class="card-img-top"
                                            alt="..."><?php
                                                    } else {
                                                        ?> <img
                                            src="../public/img/default.webp" class="card-img-top"
                                            alt="..."><?php
                                                    } ?>
                                </div>
                                <div class="card-body p-2 ajuste-flex-boxs">
                                    <div class="p-2">
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
                                    </div>
                                    <div class=" mt-5">
                                        <div class="d-flex justify-content-md-center align-items-center w-100">
                                            <a class="btn btn-outline-secondary mb-2 d-flex justify-content-md-center align-items-center w-100"
                                                style="height: 40px;"
                                                href="view-produto.php?id=<?= $prod['prod_id'] ?>">Ver</a>
                                        </div>
                                        <form class="h-auto" method="GET" action="index.php?id=">
                                            <input type="hidden" name="id" value="<?= $prod['prod_id'] ?>">
                                            <?php if ($prod['prod_quantidade'] > 0) { ?>
                                                <a onclick="AddCarrinho(<?= $prod['prod_id'] ?>)"><button type="submit"
                                                        id="AddCarrinho"
                                                        class="btn btn-secondary-personalizado p-2 w-100 ">Adicionar ao
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
                    </article>
                </main>

            <!-- Adicionar no localStorage o produto -->
        </div>
    </div>
</body>
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

</html>