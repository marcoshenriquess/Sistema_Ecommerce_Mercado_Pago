<?php
session_start();

require_once(dirname(__DIR__) . "/controller/produtoController.php");
require_once(dirname(__DIR__) . "/controller/VendaController.php");

$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

file_put_contents('../logs/notificacao_log.txt', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

$resourceUrl = $data['resource'];
$codigo_venda = explode('merchant_orders/', $resourceUrl);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$resourceUrl?access_token=APP_USR-3675747255598765-112209-09dad6dc70496c7e3367f8f5116a8179-2113437052");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$orderDetails = json_decode($response, true);
$usu_id = (int) $orderDetails['external_reference'];


$AuxControllProd = new ProdutoControll();

$AuxControllVenda = new VendaController();
$cod_venda_banco = $AuxControllVenda->ObterVenda($codigo_venda[1]);

//VERIFICA SE TEM ALGUMA VENDA COM O MESMO CÓDIGO DE VENDA
if ($codigo_venda[1] != $cod_venda_banco['cod_venda']) { 
    foreach ($orderDetails["items"] as $key => $item) {
        // var_dump('TESTE: ', $key);
        $id = $item['id'];
        $qntdRequisitada = $item['quantity'];
        $vendaValor = $item['unit_price'];

        $produto = $AuxControllProd->ObterProdutoControll($id);

        
        if ($produto['prod_quantidade'] > 0) {

            $EmEstoque = (int) $produto['prod_quantidade'];
            $QntdPosPag = $EmEstoque - $qntdRequisitada;

            $AuxControllProd->AtualizarQuantidade($id,  $QntdPosPag);
            
            $AuxControllVenda->CadastrarVenda($id, $usu_id, $qntdRequisitada, $vendaValor, $codigo_venda[1]);
        }
    }
}
