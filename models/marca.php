<?php

require_once(dirname(__DIR__) ."/database/banco.php");

class MarcaModel{
    private $marc_id;
    private $marc_nome;

    private $conn;

    public function __construct($marc_id = null, $marc_nome = null){
        $this->marc_id = $marc_id;
        $this->marc_nome = $marc_nome;
        
    }

    public function gerId(){
        return $this->marc_id;
    }
    public function setId($marc_id){
        $this->marc_id = $marc_id;
    }
    public function getNome(){
        return $this->marc_nome;
    }
    public function setNome($marc_nome){
        $this->marc_nome = $marc_nome;
    }


    public function ListaMarcas()
    {
        try{
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Marca';
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