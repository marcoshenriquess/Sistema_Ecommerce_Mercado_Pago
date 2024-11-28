<?php

// INICIANDO A SESSION
session_start();

require_once(dirname(__DIR__) . "/models/produto.php");
require_once(dirname(__DIR__) . "/models/pagamento.php");

$AuxModel = new ProdutoModel();
$AuxPaga = new Pagamento();

// CHECAGEM DA QUANTIDADE DIPONÍVEL DO PRODUTO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'maisQtde') {
        $prod_id = $_POST['prod_id'];
        $QtdeRequisitada = $_POST['QtdeReq'];
        if ($prod_id) {
            $result = $AuxModel->VerificarEstoque($prod_id, $QtdeRequisitada);
            if ($result['STATUS_PROD'] == '1') {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo "ID do produto não foi informado.";
        }
    }


    // EXCLUINDO CERTO PRODUTO DO CARRINHO ATRAVÉS DO ID DO PRODUTO
    if ($_POST['action'] === 'ExcluirItem') {
        $prod_id = $_POST['prod_id'];
        if ($prod_id) {
            foreach ($_SESSION['carrinho'] as $key => $item) {
                if ($item['prod_id'] == $prod_id) {
                    unset($_SESSION['carrinho'][$key]);
                    break;
                }
            }

            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
        } else {
            echo "ID do produto não foi informado.";
        }
    }

    if ($_POST["action"] === 'FinalizarCompra') {
        $itens = json_decode($_POST['itens'], true);
        $User = $_SESSION['usuario_logado'];

        $AuxPaga->CompraDeProduto($User, $itens);
    }
}
