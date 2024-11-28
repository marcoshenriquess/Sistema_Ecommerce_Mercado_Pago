<?php

require_once(dirname(__DIR__) ."/database/banco.php");

class EstadoModel{
    private $id_estado;
    private $nome_estado;

    private $conn;

    public function __construct($id_estado = null, $nome_estado = null){
        $this->id_estado = $id_estado;
        $this->nome_estado = $nome_estado;
        
    }

    public function getIdEstado(){
        return $this->id_estado;
    }
    public function setIdEstado($id_estado){
        $this->id_estado = $id_estado;
    }
    public function getNomeEstado(){
        return $this->nome_estado;
    }
    public function setNomeEstado($nome_estado){
        $this->nome_estado = $nome_estado;
    }

    public function ListEstado()
    {
        try{
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Estado';
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