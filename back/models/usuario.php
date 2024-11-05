<?php

require_once('C:/xampp/htdocs/project/back/database/banco.php');
class UsuarioModel
{
    private $id;
    private $nome;
    private $cpf;
    private $numero;
    private $email;
    private $senha;
    private $tipo_user;
    private $endereco;
    private $estado;
    private $cidade;
    private $complemento;
    private $conn;

    public function __construct($id = null, $nome = null, $cpf = null, $numero = null, $email = null, $senha = null, $tipo_user = null, $endereco = null, $estado = null, $cidade = null, $complemento = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->numero = $numero;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo_user = $tipo_user;
        $this->endereco = $endereco;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->complemento = $complemento;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getTipoUser()
    {
        return $this->tipo_user;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function LoginModel( $email, $senha)
    {
        $db = new Database();
        $this->conn = $db->getConnection();

        $sql = 'SELECT * FROM usuarios WHERE email = :email AND senha = :senha';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();

        $auxLogin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($auxLogin) {
            $stmt->closeCursor();
            if ($stmt === null) {
                echo "Conexão fechada.";
            }
            return header('Location: private/produtos.php');
        } else {
            $stmt->closeCursor();
            if ($stmt === null) {
                echo "Conexão fechada.";
            }

            return header('Location: login.php');
        }

    }
}

?>
