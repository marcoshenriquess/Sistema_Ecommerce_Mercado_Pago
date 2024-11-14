<?php

require_once('C:/xampp/htdocs/project/database/banco.php');

class TipoUsuarioModel{
    private $id_tipo_user;
    private $tipo_user_nome;

    private $conn;

    public function __construct($id_tipo_user = null, $tipo_user_nome = null){
        $this->id_tipo_user = $id_tipo_user;
        $this->tipo_user_nome = $tipo_user_nome;
        
    }

    public function getIdTipoUser(){
        return $this->id_tipo_user;
    }
    public function setIdTipoUser($id_tipo_user){
        $this->id_tipo_user = $id_tipo_user;
    }
    public function getNomeTipoUser(){
        return $this->tipo_user_nome;
    }
    public function setNomeTipoUser($tipo_user_nome){
        $this->tipo_user_nome = $tipo_user_nome;
    }


    
    public function Listar()
    {
        try{
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Tipos_Users';
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $AuxBancoController = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $AuxBancoController;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ObterID($id)
    {
        try{
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'select * from Tipos_Users where id_tipo_user = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $AuxBancoController = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $AuxBancoController;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}


?>