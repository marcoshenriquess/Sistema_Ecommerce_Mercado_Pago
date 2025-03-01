<?php

require_once(dirname(__DIR__) ."/database/banco.php");

class TipoProdutoModel{
    private $id_tipo_produto;
    private $nome_tipo_produto;

    private $conn;

    public function __construct($id_tipo_produto = null, $nome_tipo_produto = null){
        $this->id_tipo_produto = $id_tipo_produto;
        $this->nome_tipo_produto = $nome_tipo_produto;
        
    }

    public function getIdProduto(){
        return $this->id_tipo_produto;
    }
    public function setIdProduto($id_tipo_produto){
        $this->id_tipo_produto = $id_tipo_produto;
    }
    public function getNomeProduto(){
        return $this->nome_tipo_produto;
    }
    public function setNomeProduto($nome_tipo_produto){
        $this->nome_tipo_produto = $nome_tipo_produto;
    }


    public function ListTipoProduto()
    {
        try{
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Tipos_Produtos';
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            
            // ENCERRANDO CONEXÃO COM O BANCO
            $stmt->closeCursor();

            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}


?>