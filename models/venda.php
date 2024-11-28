<?php
require_once(dirname(__DIR__) . "/database/banco.php");

class VendaModel
{
    public $ven_id;
    public $ven_prod_id;
    public $ven_usu_id;
    public $ven_quantidade;
    public $ven_valor;
    public $conn;

    public function __construct($ven_id = null, $ven_prod_id = null, $ven_usu_id = null, $ven_quantidade = null, $ven_valor = null)
    {
        $this->ven_id = $ven_id;
        $this->ven_prod_id = $ven_prod_id;
        $this->ven_usu_id = $ven_usu_id;
        $this->ven_quantidade = $ven_quantidade;
        $this->ven_valor = $ven_valor;
    }

    public function getIdVenda()
    {
        return $this->ven_id;
    }
    public function setIdVenda($ven_id)
    {
        $this->ven_id = $ven_id;
    }
    public function getProdutoId()
    {
        return $this->ven_prod_id;
    }
    public function setProdutoId($ven_prod_id)
    {
        $this->ven_prod_id = $ven_prod_id;
    }
    public function getUsuarioId()
    {
        return $this->ven_usu_id;
    }
    public function setUsuarioId($ven_usu_id)
    {
        $this->ven_usu_id = $ven_usu_id;
    }
    public function getQuantidade()
    {
        return $this->ven_quantidade;
    }
    public function setQuantidade($ven_quantidade)
    {
        $this->ven_quantidade = $ven_quantidade;
    }
    public function getValor()
    {
        return $this->ven_valor;
    }
    public function setValor($ven_valor)
    {
        $this->ven_valor = $ven_valor;
    }

    public function ObeterVenda($id){
        try{
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT cod_venda FROM venda WHERE cod_venda = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function CadastrarVenda($id_prod, $user, $quantidade, $valor, $codigo_venda)
    {
        try {
            // var_dump($codigo_venda);
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'INSERT INTO Venda (ven_prod_id, ven_usu_id, ven_quantidade, ven_valor, cod_venda) values (:id_prod,:id_usu,:quantidade,:valor, :cod_venda)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id_prod', $id_prod, PDO::PARAM_INT);
            $stmt->bindValue(':id_usu', $user, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(':valor', $valor, PDO::PARAM_INT);
            $stmt->bindValue(':cod_venda', $codigo_venda, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $stmt;
    }
}
