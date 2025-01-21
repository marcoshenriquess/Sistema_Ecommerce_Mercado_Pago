<?php

require_once(dirname(__DIR__) ."/database/banco.php");

class CategoriaPaiModel{
    private $catPai_id;
    private $catPai_nome;

    private $conn;

    public function __construct($catPai_id = null, $catPai_nome = null){
        $this->catPai_id = $catPai_id;
        $this->catPai_nome = $catPai_nome;
        
    }

    public function gerId(){
        return $this->catPai_id;
    }
    public function setId($catPai_id){
        $this->catPai_id = $catPai_id;
    }
    public function getNome(){
        return $this->catPai_nome;
    }
    public function setNome($catPai_nome){
        $this->catPai_nome = $catPai_nome;
    }


    public function ListaCategorias()
    {
        try{
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Categoria_Pai';
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