<?php

require_once(dirname(__DIR__).'/models/venda.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'RendimentoTotal') {
        $result = [];
        $AuxModelVenda = new VendaModel();
        $result = $AuxModelVenda->TotalValorVendaProd();
        // $TotalRendimentoDia = $AuxModelVenda->TotalValorVendaProdNoDia();
        // var_dump($result);
        echo json_encode($result);
    } elseif ($_GET['action'] === 'ConsultaMediaAnual') {
        $AuxModelVenda = new VendaModel();
        $resultno = $AuxModelVenda->MediaValorVendaNoAno();
        echo json_encode($resultno);


        // $TotalRendimentoDia = $AuxModelVenda->TotalValorVendaProdNoDia();
        // echo json_encode($resultnoMes);
    }elseif ($_GET['action'] === 'ConsultaValorVendaMes') {
        $AuxModelVenda = new VendaModel();
        $result = $AuxModelVenda->ConsultaValorVendaMes();
        echo json_encode($result);

    }
}

class CatVen{
    function CategoriasVenda(){
        $AuxModelVenda = new VendaModel();
        $result = $AuxModelVenda->ConsultaDados();
        return $result;        
    }
}


