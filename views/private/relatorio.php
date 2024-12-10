<?php


include_once("../../models/permissao.php");

require_once("C:/xampp/htdocs/project/controller/produtoController.php");
require_once("C:/xampp/htdocs/project/controller/VendaController.php");

use Dompdf\Dompdf;

require_once('../../public/vendor/autoload.php');

if ($_GET['id'] == 1) {
    $ProdutosCont = new ProdutoControll();
    $List = $ProdutosCont->ListaAllProduto();

    if ($List > 0) {
        $html = "<table style='width: 100%' border='1'>";

        $html .= "<tr>";
        $html .= "<th style='text-align: center;' > ID </th>";
        $html .= "<th style='text-align: left;' > NOME </th>";
        $html .= "<th style='text-align: center;' > VALOR </th>";
        $html .= "<th style='text-align: center;' > QUANTIDADE </th>";
        $html .= "<tr' >";
        foreach ($List as $prod) {
            $html .= "<tr class=''>";
            $html .= "<td>" . htmlspecialchars($prod['prod_id']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prod['prod_nome']) . "</td>";
            $html .= "<td style='text-align: center;'>" . htmlspecialchars($prod['prod_venda']) . "</td>";
            $html .= "<td style='text-align: center;'>" . htmlspecialchars($prod['prod_quantidade']) . "</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";



        $dompdf = new Dompdf();
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();
        $dompdf->stream();
    } else {
        $html .= "Nenhum dado encontrado";
    }
} else if ($_GET['id'] == 2) {
    $AuxVendaControll = new VendaController();
    $List = $AuxVendaControll->ObterAllVenda();

    if ($List > 0) {

        $html = "<table style='width: 100%' border='1'>";

        $html .= "<tr>";
        $html .= "<th style='text-align: left;' > CODIGO </th>";
        $html .= "<th style='text-align: left; width: 100px;' > CLIENTE </th>";
        $html .= "<th style='text-align: left; width: 300px;' > PRODUTO </th>";
        $html .= "<th style='text-align: center;' > QUANTIDADE </th>";
        $html .= "<th style='text-align: center;' > VALOR </th>";
        $html .= "<th style='text-align: center;' > DATA </th>";
        $html .= "<tr' >";
        foreach ($List as $venda) {

            $Total =  $venda['ven_valor'] * $venda['ven_quantidade'];

            $html .= "<tr style='heigth: 30px;'>";
            $html .= "<td>" . $venda['cod_venda'] . "</td>";
            $html .= "<td style='text-align: left; width: 70px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>" . $venda['usu_nome'] . "</td>";
            $html .= "<td overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>" . $venda['prod_nome'] . "</td>";
            $html .= "<td style='text-align: center; width: 20px;'>" . $venda['ven_quantidade'] . "</td>";
            $html .= "<td style='text-align: center;'>R$ " . number_format($Total, 2, ',', '.') . "</td>";
            $html .= "<td style='text-align: center;'>" . $venda['ven_dt'] . "</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";



        $dompdf = new Dompdf();
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();
        $dompdf->stream();
    } else {
        $html .= "Nenhum dado encontrado";
    }
}
