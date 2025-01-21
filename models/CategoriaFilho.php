<?php

require_once(dirname(__DIR__) . "/database/banco.php");

class CategoriaFilhoModel
{
    private $catFilho_id;
    private $catFilho_nome;

    private $conn;

    public function __construct($catFilho_id = null, $catFilho_nome = null)
    {
        $this->catFilho_id = $catFilho_id;
        $this->catFilho_nome = $catFilho_nome;
    }

    public function gerId()
    {
        return $this->catFilho_id;
    }
    public function setId($catFilho_id)
    {
        $this->catFilho_id = $catFilho_id;
    }
    public function getNome()
    {
        return $this->catFilho_nome;
    }
    public function setNome($catFilho_nome)
    {
        $this->catFilho_nome = $catFilho_nome;
    }


    public function ListaCategorias($id)
    {
        try {
            // CONEXÃO COM O BANCO
            $db = new Database();
            $this->conn = $db->getConnection();

            // SQL query
            $sql = 'SELECT * FROM Categoria_Filho WHERE catFilho_catPai = :id';
            $stmt = $this->conn->prepare($sql);

            // Bind the parameter
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the results
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Close the cursor
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $result = $e->getMessage(); // Capture error message if query fails
        }

        return $result;
    }
}
