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

        $stmt->closeCursor();

        if ($auxLogin) {
            session_start();
            $_SESSION['logado'] = true;
            return header('Location: private/index.php');
        } else {

            return header('Location: login.php');
        }

    }


    public function CadastrarUsuario($dados){
        $db = new Database();
        $this->conn = $db->getConnection();
        
        $sql = 'INSERT INTO usuarios (nome, cpf, numero, email, senha, tipo_user, endereco, estado, cidade, complemento) VALUES (:nome, :cpf, :numero, :email, :senha, :tipo_user, :endereco, :estado, :cidade, :complemento);';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome',$dados->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':cpf',$dados->getCpf(), PDO::PARAM_STR);
        $stmt->bindValue(':numero',$dados->getNumero(), PDO::PARAM_STR);
        $stmt->bindValue(':email',$dados->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':senha',$dados->getSenha(), PDO::PARAM_STR);
        $stmt->bindValue(':tipo_user',$dados->getTipoUser(), PDO::PARAM_STR);
        $stmt->bindValue(':endereco',$dados->getEndereco(), PDO::PARAM_STR);
        $stmt->bindValue(':estado',$dados->getEstado(), PDO::PARAM_STR);
        $stmt->bindValue(':cidade',$dados->getCidade(), PDO::PARAM_STR);
        $stmt->bindValue(':complemento',$dados->getComplemento(), PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt->closeCursor();
        
    }
    public function ListaUsuarios(){
        $db = new Database();
        $this->conn = $db->getConnection();

        $sql = 'SELECT * FROM usuarios 
        INNER JOIN Tipos_Users ON usuarios.tipo_user = Tipos_Users.id_tipo_user;';
        $stmt = $this->conn->query($sql);
        $AuxBancoController = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        return $AuxBancoController;

    }
    public function ObterUsuario($id){
        $db = new Database();
        $this->conn = $db->getConnection();

        $sql = 'SELECT * FROM usuarios 
        INNER JOIN Tipos_Users ON usuarios.tipo_user = Tipos_Users.id_tipo_user
        WHERE id_usuario = ?;';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $AuxBancoController = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $AuxBancoController;

    }

    public function AlterarUsuario($dados, $id){
        $db = new Database();
        $this->conn = $db->getConnection();
        
        $sql = "UPDATE usuarios SET 
        nome = :nome, cpf = :cpf, numero = :numero, email = :email,
        senha = :senha, tipo_user = :tipo_user, endereco = :endereco,
        estado = :estado, cidade = :cidade, complemento = :complemento
        WHERE id_usuario = $id; ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome',$dados->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':cpf',$dados->getCpf(), PDO::PARAM_STR);
        $stmt->bindValue(':numero',$dados->getNumero(), PDO::PARAM_STR);
        $stmt->bindValue(':email',$dados->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':senha',$dados->getSenha(), PDO::PARAM_STR);
        $stmt->bindValue(':tipo_user',$dados->getTipoUser(), PDO::PARAM_STR);
        $stmt->bindValue(':endereco',$dados->getEndereco(), PDO::PARAM_STR);
        $stmt->bindValue(':estado',$dados->getEstado(), PDO::PARAM_STR);
        $stmt->bindValue(':cidade',$dados->getCidade(), PDO::PARAM_STR);
        $stmt->bindValue(':complemento',$dados->getComplemento(), PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt->closeCursor();
        
    }



    public function ExcluirUsuario($id){
        $db = new Database();
        $this->conn = $db->getConnection();

        $sql = "DELETE FROM usuarios WHERE id_usuario = $id";
        $smtm = $this->conn->query($sql);
        $smtm->execute();

        $smtm->closeCursor();
    }
}

?>
