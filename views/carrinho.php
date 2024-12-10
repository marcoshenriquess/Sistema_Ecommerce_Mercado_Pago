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


            const inputs2 = document.querySelector(`input[id^='${id}_valor_']`).value || 0;
            const valorProd = parseFloat(inputs2.replace(/\./g, '').replace(',', '.')) || 0;


            // Realiza a soma corretamente.
            const Total = ValorParaSoma += (valorProd * quantidadeSalva);

            // Formata o resultado com duas casas decimais e separador brasileiro.
            const ValorFormatado = Total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            const TESTE = document.querySelector("#total");
            TESTE.innerHTML = ValorFormatado;


        });
    };

    function removeCaracteresMoney(caracteres) {
        const RemoveOtherCarac = caracteres.replace(/[^0-9,.-]+/g, '');
        const valorLimpo = RemoveOtherCarac.replace(/\./g, '');
        const FormatFinal = valorLimpo.replace(',', '.');
        return parseFloat(FormatFinal);
    }

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

            const GetValor = document.querySelector(`input[id^='${id}_valor_']`).value;
            const ValorProduto = parseFloat(removeCaracteresMoney(GetValor));

            const GetCarrinhototal = document.getElementById('total').textContent;
            const ValorCarrinho = parseFloat(removeCaracteresMoney(GetCarrinhototal));

            const ValorTotalCarrinho = ValorCarrinho - ValorProduto;

            const ValorFormatado = ValorTotalCarrinho.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });


            document.getElementById('total').textContent = ValorFormatado;

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


                    const GetValor = document.querySelector(`input[id^='${id}_valor_']`).value;
                    const ValorProduto = parseFloat(removeCaracteresMoney(GetValor));

                    const GetCarrinhototal = document.getElementById('total').textContent;
                    const ValorCarrinho = parseFloat(removeCaracteresMoney(GetCarrinhototal));

                    const ValorTotalCarrinho = ValorCarrinho + ValorProduto;

                    const ValorFormatado = ValorTotalCarrinho.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });

                    const TESTE = document.querySelector("#total");
                    document.getElementById('total').textContent = ValorFormatado;

                }
            },
            error: function(err) {
                console.error("Erro na REQ:", err);
            }
        });

    }

    function FinalizarCompra($idUsu) {
        $User = $idUsu;
            if ($User) {
                const inputs = document.querySelectorAll("input[id^='quantidade_']");
                let itens = []; // Array para armazenar os dados dos produtos

                inputs.forEach(input => {
                    const id = input.id.split('_')[1];
                    const quantidade = document.getElementById('quantidade_' + id).value;
                    const valor = document.querySelector(`input[id^='${id}_valor_']`).value;
                    const valorLimpo = valor.replace(/\./g, '');
                    const FormatFinal = valorLimpo.replace(',', '.');

                    // Adiciona o produto ao array de itens
                    itens.push({
                        prod_id: id,
                        qntd: quantidade,
                        valor: FormatFinal
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
                        if (res) {
                            const data = JSON.parse(res); // Converte a string JSON em um objeto
                            const url = data.url; // Acessa a propriedade 'url'
                            window.open(url, '_blank');
                            localStorage.clear();
                        } else {
                            document.getElementById('ErrCompra').textContent = "Não foi possível realizar a compra! Tente novamente mais tarde!!";
                        }
                    },
                    error: function(err) {
                        console.error("Erro na requisição:", err);
                    }
                });
            } else {
                window.location.href = "Login.php";
            }
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
                                <?php
                                $image_path = "../public/img/uploads/" .$item['prod_imagem'];
                                     if(file_exists($image_path)){
                                        ?><img src="../public/img/uploads/<?= $item['prod_imagem'] ?>" style="width: 100px;" class="img-profile rounded"><?php
                                     } else {
                                         ?><img src="../public/img/default.webp" style="width: 100px;" class="img-profile rounded"><?php
                                     }

                                ?>
                                <span class="p-2 w-75 flex-grow-1 bd-highlight">
                                    <p class="m-2"><?= $item['prod_nome'] ?></p>

                                    <?php if ($item['prod_desconto'] > 0) { ?>
                                        <sup>
                                            <p class="txt-gray ft-size-10 fs-6 line">R$ <?= $item['prod_venda'] ?></p>
                                        </sup>
                                        <?php
                                        $ValorDesconto = ($item['prod_desconto'] / 100) * $item['prod_venda'];
                                        $Result = $item['prod_venda'] - $ValorDesconto;
                                        $ValorComDescoto = number_format($Result, 2, ',', '.');
                                        if ($ValorComDescoto > 0) {
                                            $VendaTotal += $Result;
                                        } else {
                                            $VendaTotal = $Result;
                                        }
                                        $item['ValorDe'] = $ValorComDescoto;
                                        ?>
                                        <p class="txt-black ft-size-13">R$ <?= $item['ValorDe'] ?></p>
                                        <input type="hidden" id="<?= $item['prod_id'] ?>_valor_<?= $item['ValorDe'] ?>" value="<?= $item['ValorDe'] ?>">
                                    <?php } else { ?>
                                        <?php
                                        $ValorOriginal = number_format($item['prod_venda'], 2, ',', '.');
                                        ?>
                                        <p class="txt-black ft-size-13 ">R$ <?= $ValorOriginal ?></p>
                                        <input type="hidden" id="<?= $item['prod_id'] ?>_valor_<?= $ValorOriginal ?>" value="<?= $ValorOriginal ?>">
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
                                    Total: &nbsp
                                <p id="total" class="txt-white fs-1 edit-p-margin"></p>
                                </p>
                            </li>
                            <li class="list-group-item bd-highlight edit-li-border bg-secondary bg-gradient"><button class="btn btn-success" onclick="FinalizarCompra(<?php if (isset($_SESSION['usuario_logado'])) {
                                                                                                                                                                            echo $_SESSION['usuario_logado']['usu_id'];
                                                                                                                                                                        } else {
                                                                                                                                                                            $err = true;
                                                                                                                                                                        } ?>)">Comprar</button></li>
                            <li class="list-group-item bd-highlight edit-li-border bg-secondary bg-gradient"><a href="index.php" class="btn btn-warning">Voltar</a></li>
                        </ul>
                    <?php } ?>
                    </div>
                    <span id="ErrCompra" class="text-danger"></span>
                </div>
        </div>
        


</body>

</html>