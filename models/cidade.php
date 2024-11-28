<?php

require_once(dirname(__DIR__) ."/database/banco.php");

class CidadeModel{
    private $id_cidade;
    private $nome_cidade;

    private $conn;

    public function __construct($id_cidade = null, $nome_cidade = null){
        $this->id_cidade = $id_cidade;
        $this->nome_cidade = $nome_cidade;
        
    }

    public function getIdCidade(){
        return $this->id_cidade;
    }
    public function setIdCidade($id_cidade){
        $this->id_cidade = $id_cidade;
    }
    public function getNomecidade(){
        return $this->nome_cidade;
    }
    public function setNomecidade($nome_cidade){
        $this->nome_cidade = $nome_cidade;
    }

    public function ListCidade()
    {
        try{
                // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Cidade;';
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // ENCERRANDO CONEXÃO COM O BANCO
            $stmt->closeCursor();

            return $result;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}


?>