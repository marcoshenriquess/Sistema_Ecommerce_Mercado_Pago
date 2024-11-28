<?php
require_once(dirname(__DIR__) . "/controller/produtoController.php");
require_once(dirname(__DIR__) . "/controller/CarrinhoController.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once('head.php');
$VendaTotal = 0;
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.onload = function() {
        // Procura por todos os inputs de quantidade
        const inputs = document.querySelectorAll("input[id^='quantidade_']");
        let ValorParaSoma = 0;
        inputs.forEach(input => {
            const id = input.id.split('_')[1]; // Extrai o ID do produto do input
            const quantidadeSalva = localStorage.getItem('quantidade_' + id);

            if (quantidadeSalva !== null) {
                // Atualiza o valor do input com o valor salvo
                input.value = quantidadeSalva;
            }
            const inputs2 = parseFloat(document.querySelector(`input[id^='${id}_valor_']`).value) || 0;
            const Total = ValorParaSoma += (inputs2 * quantidadeSalva);

            const TESTE = document.querySelector("#total");
            TESTE.innerHTML = Total.toFixed(2).replace('.', ',');


        });
    };



    function ExcluirItem(id) {

        localStorage.setItem('quantidade_' + id, 1);
        var prod_id = id;
        $.ajax({
            url: "../controller/CarrinhoController.php",
            type: 'POST',
            data: {
                action: 'ExcluirItem',
                prod_id: prod_id
            },
            success: function(res) {
                localStorage.removeItem("quantidade_" + id);
                window.location.reload(true);
            },
            error: function(err) {
                console.error("Erro na REQ:", err);
            }
        });
    }

    function menosQtde(id) {
        const quantidade = document.getElementById('quantidade_' + id);
        const valorAtual = parseInt(quantidade.value) || 0;

        if (valorAtual > 1) {
            quantidade.value = valorAtual - 1;
            localStorage.setItem('quantidade_' + id, quantidade.value);

            const ValorProduto = document.querySelector(`input[id^='${id}_valor_']`).value;

            let ValorAtual = document.getElementById('total').textContent.replace(',', '.');

            let ValorTotal = parseFloat(ValorAtual) - parseFloat(ValorProduto);

            document.getElementById('total').textContent = `${ValorTotal.toFixed(2).replace('.', ',')}`;
        }

    }

    function maisQtde(id) {
        var prod_id = id;
        var quantidade = document.getElementById('quantidade_' + id);
        var QuantidadeAtual = parseInt(localStorage.getItem('quantidade_' + id)) || 0;

        var quantReq = quantidade.value;
        $.ajax({
            url: "../controller/CarrinhoController.php",
            type: 'POST',
            data: {
                action: 'maisQtde',
                prod_id: prod_id,
                QtdeReq: quantReq
            },
            success: function(res) {
                if (res === 'false') {
                    quantidade.value = QuantidadeAtual;
                } else {
                    quantidade.value = QuantidadeAtual + 1;
                    localStorage.setItem('quantidade_' + id, quantidade.value);

                    const ValorProduto = document.querySelector(`input[id^='${id}_valor_']`).value;

                    let ValorAtual = document.getElementById('total').textContent.replace(',', '.');

                    let ValorTotal = parseFloat(ValorAtual) + parseFloat(ValorProduto);

                    document.getElementById('total').textContent = `${ValorTotal.toFixed(2).replace('.', ',')}`;

                    // const inputs = document.querySelectorAll("input[id^='quantidade_']");
                    // let ValorParaSoma = 0;
                    // inputs.forEach(input => {
                    //     const id = input.id.split('_')[1]; // Extrai o ID do produto do input
                    //     const quantidadeSalva = localStorage.getItem('quantidade_' + id);

                    //     if (quantidadeSalva !== null) {
                    //         // Atualiza o valor do input com o valor salvo
                    //         input.value = quantidadeSalva;
                    //     }
                    //     const inputs2 = document.querySelector(`input[id^='${id}_valor_']`);

                    //     const valor = parseFloat(inputs2.value) || 0;
                    //     const Total = ValorParaSoma += (valor * quantidadeSalva);

                    //     document.getElementById('total').textContent = `${parseInt(localStorage.getItem('quantidade_' + id))}`
                    //     // TESTE.innerHTML = Total.toFixed(2).replace('.', ',');
                    // });

                    // window.location.reload(true);
                }
            },
            error: function(err) {
                console.error("Erro na REQ:", err);
            }
        });

    }


    function FinalizarCompra() {
        const inputs = document.querySelectorAll("input[id^='quantidade_']");
        let itens = []; // Array para armazenar os dados dos produtos

        inputs.forEach(input => {
            const id = input.id.split('_')[1];
            const quantidade = document.getElementById('quantidade_' + id).value;
            const valor = document.querySelector(`input[id^='${id}_valor_']`).value;

            // Adiciona o produto ao array de itens
            itens.push({
                prod_id: id,
                qntd: quantidade,
                valor: valor
            });
        });

        // Envia o array de itens para a controller em uma única requisição
        $.ajax({
            url: '../controller/CarrinhoController.php',
            type: 'POST',
            data: {
                action: 'FinalizarCompra',
                itens: JSON.stringify(itens) // Serializa o array para enviar como string
            },
            success: function(res) {
                const data = JSON.parse(res); // Converte a string JSON em um objeto
                const url = data.url; // Acessa a propriedade 'url'
                window.open(url, '_blank');
                localStorage.clear();
            },
            error: function(err) {
                console.error("Erro na requisição:", err);
            }
        });
    }
</script>

<body>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content " class="w-100 d-flex flex-column align-items-center">
            <div class="w-100">
                <?php include_once("menu.php"); ?>
            </div>
            <?php if (empty($_SESSION['carrinho'])) { ?>
                <div class="content w-50 align-items-center m-5">
                    <?php echo "O carrinho está vazio."; ?>
                <?php } else { ?>
                    <div class="content border w-50 align-items-center m-5">
                        <ul class="list-group list-group-flush"></ul>
                        <?php foreach ($_SESSION['carrinho'] as $item): ?>
                            <input type='hidden' id='id_do_produto' value="<?= $item['prod_id'] ?>">
                            <li class="list-group-item d-flex bd-highlight">
                                <?php if ($item['prod_desconto'] > 0) { ?>
                                    <span class="badge bg-danger m-1 p-1 zindex-fixed txt-white">-<?= $item['prod_desconto'] ?>% OFF</span>
                                <?php } ?>
                                <span class=""><img src="../public/img/uploads/<?= $item['prod_imagem'] ?>" style="width: 100px;" class="img-profile rounded"></span>
                                <span class="p-2 w-75 flex-grow-1 bd-highlight">
                                    <p class="m-2"><?= $item['prod_nome'] ?></p>

                                    <?php if ($item['prod_desconto'] > 0) { ?>
                                        <sup>
                                            <p class="txt-gray ft-size-10 fs-6 line">R$ <?= $item['prod_venda'] ?></p>
                                        </sup>
                                        <?php
                                        $ValorDesconto = ($item['prod_desconto'] / 100) * $item['prod_venda'];
                                        $Result = $item['prod_venda'] - $ValorDesconto;
                                        $ValorComDescoto = number_format($Result, 2, '.', ',');
                                        if ($ValorComDescoto > 0) {
                                            $VendaTotal += $Result;
                                        } else {
                                            $VendaTotal = $Result;
                                        }
                                        $item['ValorDe'] = $ValorComDescoto;
                                        ?>
                                        <p class="txt-black ft-size-13">R$ <?= $item['ValorDe'] ?></p>
                                        <input type="hidden" id="<?= $item['prod_id'] ?>_valor_<?= $item['ValorDe'] ?>" value="<?= $item['ValorDe'] ?>">
                                    <?php } else {
                                        if ($item['prod_venda'] > 0) {
                                            $VendaTotal += $item['prod_venda'];
                                        } else {
                                            $VendaTotal = $item['prod_venda'];
                                        } ?>
                                        <p class="txt-black ft-size-13 ">R$ <?= $item['prod_venda'] ?></p>
                                        <input type="hidden" id="<?= $item['prod_id'] ?>_valor_<?= $item['prod_venda'] ?>" value="<?= $item['prod_venda'] ?>">
                                    <?php } ?>
                                </span>
                                <div class="topbar-divider d-none d-sm-block"></div>
                                <span class="edit-position-box nav-item bg-transparent">
                                    <input type="button" value="-" id="menosQtd" onclick="menosQtde(<?= $item['prod_id'] ?>)">
                                    <input type='number' class="w-50" disabled readonly='readonly' id='quantidade_<?= $item['prod_id'] ?>' value="1" oninput="atualizaTotal()">
                                    <input type="button" value="+" id="maisQtde" onclick="maisQtde(<?= $item['prod_id'] ?>)">

                                </span>
                                <span class="p-2 edit-position-box bg-transparent">

                                    <input type="button" class="btn btn-danger" id="maisQtde" onclick="ExcluirItem(<?= $item['prod_id'] ?>)" value="Excluir">
                                </span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                        <ul class="d-grid gap-2 d-md-flex justify-content-md-end edit-end-box bg-secondary bg-gradient m-0">
                            <li class="list-group-item bd-highlight edit-li-border-esq bg-secondary d-flex align-items-center">
                                <p class="txt-white fs-1 edit-p-margin">
                                    Total: R$ &nbsp
                                <p id="total" class="txt-white fs-1 edit-p-margin"> </p>
                                </p>
                            </li>
                            <li class="list-group-item bd-highlight edit-li-border bg-secondary bg-gradient"><button class="btn btn-success" onclick="FinalizarCompra()">Comprar</button></li>
                            <li class="list-group-item bd-highlight edit-li-border bg-secondary bg-gradient"><a href="index.php" class="btn btn-warning">Voltar</a></li>
                        </ul>
                    <?php } ?>

                    </div>
                </div>
        </div>
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