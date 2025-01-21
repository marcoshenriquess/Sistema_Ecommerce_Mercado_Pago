<?php

require_once('../controller/produtoController.php');

if (isset($_POST['produto'])) {
    $AuxCOntroll = new ProdutoControll();
    $result = $_POST['produto'];

    $produtos = $AuxCOntroll->PesquisaProduto($result);
    // echo '<pre>';
    // var_dump($produtos);
    // echo '</pre>';
} else {
    header('Location: index.php');
}
include('./head.php');

?>

<body class="bg-light">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content" class="w-100">
            <?php
            include('./menu.php');

            if (!empty($produtos) && !empty($_POST['produto'])) { ?>
                <div class="mt-3 ml-3 d-flex justify-content-start align-items-center w-75"style="font-size: 40px;">
                    <p class="text-danger mr-1" >Você pesquisou por </p>
                    <p>"<?= $_POST['produto'] ?>"</p>
                </div>
                <div class="ml-3 d-flex justify-content-start align-items-center w-75">
                    <p class="text-danger mr-1">Resultados</p>
                    <p><?= count($produtos) ?></p>
                </div>
            <?php } ?>
            <main class="w-100 mt-1  d-flex justify-content-start p-3">
                <?php
                if (!empty($produtos) && !empty($_POST['produto'])) { ?>
                    <aside class="bg-b61f24  mr-3 border-radius p-3" style="width: 300px; z-index: 1000; position: scrool; height: auto; min-height: 100px;">
                        <div>
                            <p class="fs-1 text-white">Marcas</p>
                            <div class="w-100 d-flex justify-content-start flex-column" style="flex-wrap: wrap; ">
                                <div class="checkbox-custom m-1 row">
                                    <input type="checkbox" id="checkbox-1" />
                                    <label for="checkbox-1" class="text-white">Nike</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-2" />
                                    <label for="checkbox-2" class="text-white">Adidas</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-3" />
                                    <label for="checkbox-3" class="text-white">Puma</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-4" />
                                    <label for="checkbox-4" class="text-white">Olympikus</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-5" />
                                    <label for="checkbox-5" class="text-white">New Balance</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-6" />
                                    <label for="checkbox-6" class="text-white">Fila</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-7" />
                                    <label for="checkbox-7" class="text-white">Under Armour</label>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider mt-4 border-danger"></div>
                        <div>
                            <p class="fs-1 text-white">Tamanhos:</p>
                            <div class="w-100 d-flex justify-content-start flex-column" style="flex-wrap: wrap; ">
                                <div class="checkbox-custom m-1 row">
                                    <input type="checkbox" id="checkbox-8" />
                                    <label for="checkbox-8" class="text-white">38</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-9" />
                                    <label for="checkbox-9" class="text-white">39</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-10" />
                                    <label for="checkbox-10" class="text-white">40</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-11" />
                                    <label for="checkbox-11" class="text-white">41</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-12" />
                                    <label for="checkbox-12" class="text-white">42</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-13" />
                                    <label for="checkbox-13" class="text-white">43</label>
                                </div>
                                <div class="checkbox-custom m-1">
                                    <input type="checkbox" id="checkbox-14" />
                                    <label for="checkbox-14" class="text-white">44</label>
                                </div>
                            </div>
                        </div>
                    </aside>
                <?php } else { ?>

                    <aside class="bg-trasparent mr-3" style="width: 300px; z-index: 1000; position: scrool; height: 600px;">
                    </aside>
                <?php } ?>
                <article class=" row justify-content-start" style="width: 100%;">
                    <?php if (!empty($produtos) && !empty($_POST['produto'])) {
                        foreach ($produtos as $prod): ?>
                            <!-- Loop para listar todos os produtos -->
                            <div class="card mr-3 ml-3 mb-3 rounded ajuste-card-item ajuste-flex-boxs">
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
                        <?php endforeach;
                    } else { ?>
                        <p> Nenhum produto encontrado </p>
                    <?php } ?>
                </article>
            </main>
        </div>
    </div>
</body>

</html