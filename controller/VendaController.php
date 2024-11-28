<?php
require_once(dirname(__DIR__) ."/models/venda.php");

class VendaController{
    public function CadastrarVenda($id_prod, $user, $quantidade, $valor, $codigo_venda){
        $AuxControll = new VendaModel();
        $AuxControll->CadastrarVenda($id_prod, $user, $quantidade, $valor, $codigo_venda);
    }
    public function ObterVenda($id){
        $AuxControll = new VendaModel();
        $result = $AuxControll->ObeterVenda($id);
        
        return $result;
    }
}