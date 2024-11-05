<?php
class Database {
    private $serverName = "localhost";     // Nome ou IP do servidor
    private $database = "LOJA_ESPORTIVA";       // Nome do banco de dados
    private $username = "sa";              // Nome do usuário
    private $password = "071120033";       // Senha do usuário
    public $conn;


    // Método para obter a conexão (para ser usado em outros arquivos)
    public function getConnection() {
        return $this->conn;
    }
    

    // Método construtor para criar a conexão com o banco de dados
    public function __construct() {
        try {
            $this->conn = new PDO("sqlsrv:Server=$this->serverName;Database=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

}
?>
