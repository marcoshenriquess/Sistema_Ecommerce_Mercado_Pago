<?php

require_once("../database/banco.php");
require_once("../controller/produtoController.php");


class Pagamento
{


    public function CompraDeProduto($User, $Dados)
    {
        if (!is_array($Dados)) {
            $Dados = [];
        }


        $itemsinCar = [];
        $err = false;

        foreach ($Dados as $key => $item) {
            if ($item['prod_id']) {
                $AuxControll = new ProdutoControll();
                $produto = $AuxControll->ObterProdutoControll($item["prod_id"]);
            }
            if ($produto['prod_estoque'] > 0 || $item['qntd'] < $produto['prod_estoque']) {
                $itemsinCar[] = [
                    "id" => $item["prod_id"],
                    "title" => $produto['prod_nome'],
                    "description" => $produto['prod_descricao'],
                    "quantity" => (int) $item['qntd'],
                    "currency_id" => "BRL",
                    "unit_price" => (float) $item['valor'],
                ];
            } else {
                $err = true;
            }
        }

        if (!$err) {
            $curl = curl_init();
            $data = [
                "expiration_date_from" => null,
                "expiration_date_to" => null,
                "expires" => false,
                "external_reference" => $User['usu_id'],
                "items" => $itemsinCar,
                "notification_url" => 'https://05e9-177-124-64-94.ngrok-free.app/project/API/notificacao.php',
                "payment_methods" => [
                    "excluded_payment_types" => [
                        [
                            "id" => "ticket"
                        ]
                    ],
                    "installments" => 6,
                    "default_installments" => 1
                ]
            ];

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer APP_USR-3675747255598765-112209-09dad6dc70496c7e3367f8f5116a8179-2113437052'
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            // curl_close($curl);

            // Decodificar a resposta
            $obj = json_decode($response);

            // var_dump($obj);
            if (isset($obj)) {

                $link_externo = $obj->init_point;
                unset($_SESSION['carrinho']);
                echo json_encode(['url' => $link_externo]);
            }
        } 
        
    }
}
