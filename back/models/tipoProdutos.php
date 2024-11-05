<?php

require_once('C:/xampp/htdocs/project/back/database/banco.php');

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
    public function getNomeProduto(){
        return $this->nome_tipo_produto;
    }

    public function ListTipoProduto(): array
    {
        // CONEXÃO COM O BANCO
        $db = new Database();
        $this->conn = $db->getConnection();

        $sql = 'select * from Tipos_Produtos';
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        // ENCERRANDO CONEXÃO COM O BANCO
        $stmt->closeCursor();

        return $result;
    }

}


?>