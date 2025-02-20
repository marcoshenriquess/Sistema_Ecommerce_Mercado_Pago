<?php

require_once(dirname(__DIR__) ."/database/banco.php");
class UsuarioModel
{
    private $usu_id;
    private $usu_nome;
    private $usu_cpf;
    private $usu_telefone;
    private $usu_email;
    private $usu_senha;
    private $usu_tipo;
    private $usu_endereco;
    private $usu_numero;
    private $usu_estado;
    private $usu_cidade;
    private $usu_complemento;
    private $usu_dt_ini;
    private $usu_status;
    private $usu_dt_exc;
    private $conn;

    public function __construct(
        $usu_id = null,
        $usu_nome = null,
        $usu_cpf = null,
        $usu_telefone = null,
        $usu_email = null,
        $usu_senha = null,
        $usu_tipo = null,
        $usu_endereco = null,
        $usu_numero = null,
        $usu_estado = null,
        $usu_cidade = null,
        $usu_complemento = null,
        $usu_dt_ini = null,
        $usu_status = null,
        $usu_dt_exc = null
    ) {
        $this->usu_id = $usu_id;
        $this->usu_nome = $usu_nome;
        $this->usu_cpf = $usu_cpf;
        $this->usu_telefone = $usu_telefone;
        $this->usu_email = $usu_email;
        $this->usu_senha = $usu_senha;
        $this->usu_tipo = $usu_tipo;
        $this->usu_endereco = $usu_endereco;
        $this->usu_numero = $usu_numero;
        $this->usu_estado = $usu_estado;
        $this->usu_cidade = $usu_cidade;
        $this->usu_complemento = $usu_complemento;
        $this->usu_dt_ini = $usu_dt_ini;
        $this->usu_status = $usu_status;
        $this->usu_dt_exc = $usu_dt_exc;
    }

    public function getusu_Id()
    {
        return $this->usu_id;
    }
    public function setusu_Id($usu_id)
    {
        $this->usu_id = $usu_id;
    }
    public function getusu_Nome()
    {
        return $this->usu_nome;
    }
    public function setusu_Nome($usu_nome)
    {
        $this->usu_nome = $usu_nome;
    }
    public function getusu_Cpf()
    {
        return $this->usu_cpf;
    }
    public function setusu_Cpf($usu_cpf)
    {
        $this->usu_cpf = $usu_cpf;
    }
    public function getusu_Telefone()
    {
        return $this->usu_telefone;
    }
    public function setusu_Telefone($usu_telefone)
    {
        $this->usu_telefone = $usu_telefone;
    }
    public function getusu_Email()
    {
        return $this->usu_email;
    }
    public function setusu_Email($usu_email)
    {
        $this->usu_email = $usu_email;
    }
    public function getusu_Senha()
    {
        return $this->usu_senha;
    }
    public function setusu_Senha($usu_senha)
    {
        $this->usu_senha = $usu_senha;
    }

    public function getusu_TipoUser()
    {
        return $this->usu_tipo;
    }
    public function setusu_TipoUser($usu_tipo)
    {
        $this->usu_tipo = $usu_tipo;
    }
    public function getusu_Endereco()
    {
        return $this->usu_endereco;
    }
    public function setusu_Endereco($usu_endereco)
    {
        $this->usu_endereco = $usu_endereco;
    }
    public function getusu_Numero()
    {
        return $this->usu_numero;
    }
    public function setusu_Numero($usu_numero)
    {
        $this->usu_numero = $usu_numero;
    }
    public function getusu_Estado()
    {
        return $this->usu_estado;
    }
    public function setusu_Estado($usu_estado)
    {
        $this->usu_estado = $usu_estado;
    }
    public function getusu_Cidade()
    {
        return $this->usu_cidade;
    }
    public function setusu_Cidade($usu_cidade)
    {
        $this->usu_cidade = $usu_cidade;
    }
    public function getusu_Complemento()
    {
        return $this->usu_complemento;
    }
    public function setusu_Complemento()
    {
        return $this->usu_complemento;
    }
    public function getusu_dt_ini()
    {
        return $this->usu_dt_ini;
    }
    public function setusu_dt_ini($usu_dt_ini)
    {
        $this->usu_dt_ini = $usu_dt_ini;
    }
    public function getusu_status()
    {
        return $this->usu_status;
    }
    public function setusu_status($usu_status)
    {
        $this->usu_status = $usu_status;
    }
    public function getusu_dt_exc()
    {
        return $this->usu_dt_exc;
    }
    public function setusu_dt_exc($usu_dt_exc)
    {
        $this->usu_dt_exc = $usu_dt_exc;
    }

    public function LoginModel($email, $senha)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();
            // var_dump($senha);exit();
            $sql = 'SELECT * FROM usuario 
            INNER JOIN Tipos_Users ON usuario.usu_tipo = Tipos_Users.id_tipo_user
            JOIN Cidade ON usuario.usu_cidade = Cidade.id_cidade
            JOIN Estado ON usuario.usu_estado = Estado.id_estado
            WHERE usu_email = :email AND usu_status = 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            // $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            
            $correctPassword = password_verify($senha, $usuario['usu_senha'] ?? '');
            if ($correctPassword) {
                return $usuario;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function CadastrarUsuario($dados)
    {

        try {

            $db = new Database();
            $this->conn = $db->getConnection();

            /* CRIPTOGRAFIA DA SENHA DO USUÁRIO */

            $hash = password_hash($dados->getusu_Senha(), PASSWORD_DEFAULT);
            // var_dump($hash);exit();

            $sql = 'INSERT INTO usuario 
                (usu_nome, 
                usu_cpf, 
                usu_telefone, 
                usu_email, 
                usu_senha, 
                usu_tipo, 
                usu_endereco, 
                usu_numero, 
                usu_estado, 
                usu_cidade, 
                usu_complemento, 
                usu_dt_ini, 
                usu_status, 
                usu_dt_exc) VALUES (
                :nome, 
                :cpf, 
                :telefone, 
                :email, 
                :senha, 
                :tipo_user, 
                :endereco,
                :numero,
                :estado, 
                :cidade, 
                :complemento,
                GETDATE(),
                1,
                null);';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $dados->getusu_Nome(), PDO::PARAM_STR);
            $stmt->bindValue(':cpf', $dados->getusu_Cpf(), PDO::PARAM_STR);
            $stmt->bindValue(':telefone', $dados->getusu_Telefone(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $dados->getusu_Email(), PDO::PARAM_STR);
            $stmt->bindValue(':senha', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':tipo_user', $dados->getusu_TipoUser(), PDO::PARAM_STR);
            $stmt->bindValue(':endereco', $dados->getusu_Endereco(), PDO::PARAM_STR);
            $stmt->bindValue(':numero', $dados->getusu_Numero(), PDO::PARAM_STR);
            $stmt->bindValue(':estado', $dados->getusu_Estado(), PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $dados->getusu_Cidade(), PDO::PARAM_STR);
            $stmt->bindValue(':complemento', $dados->getusu_Complemento(), PDO::PARAM_STR);

            $stmt->execute();

            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ListaUsuarios()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT usu_id,usu_nome,usu_email,Tipos_Users.tipo_user_nome,Cidade.nome_cidade,Estado.nome_estado, usu_status,usu_cpf FROM usuario 
            INNER JOIN Tipos_Users ON usuario.usu_tipo = Tipos_Users.id_tipo_user
            INNER JOIN Cidade ON usuario.usu_cidade = Cidade.id_cidade
            INNER JOIN Estado ON usuario.usu_estado = Estado.id_Estado WHERE usu_status = 1;';
            $stmt = $this->conn->query($sql);
            $AuxBancoController = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $AuxBancoController;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ObterUsuario($id)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT * FROM usuario 
            INNER JOIN Tipos_Users ON usuario.usu_tipo = Tipos_Users.id_tipo_user
            JOIN Cidade ON usuario.usu_cidade = Cidade.id_cidade
            JOIN Estado ON usuario.usu_estado = Estado.id_estado
            WHERE usu_id = ? AND usu_status = 1;';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $AuxBancoController = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();


            return $AuxBancoController;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function AlterarUsuario($dados, $id)
    {
        try {

            $db = new Database();
            $this->conn = $db->getConnection();

            /* CRIPTOGRAFIA DA SENHA DO USUÁRIO */

            $hash = password_hash($dados->getusu_Senha(), PASSWORD_ARGON2ID);
            // var_dump($hash);exit();
            $sql = "UPDATE usuario SET 
            usu_nome = :nome, usu_cpf = :cpf, usu_telefone = :telefone, usu_email = :email,
            usu_senha = :senha, usu_tipo = :tipo_user, usu_endereco = :endereco, usu_numero = :numero,
            usu_estado = :estado, usu_cidade = :cidade, usu_complemento = :complemento
            WHERE usu_id = $id; ";
            $stmt = $this->conn->prepare($sql);
            if ($dados->getusu_Nome() != null) {
                $stmt->bindValue(':nome', $dados->getusu_Nome(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':nome', $Usuario['usu_nome'], PDO::PARAM_STR);
            }

            
            if ($dados->getusu_Cpf() != null) {
                $stmt->bindValue(':cpf', $dados->getusu_Cpf(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':cpf', $Usuario['usu_cpf'], PDO::PARAM_STR);
            }

            
            if ($dados->getusu_Telefone() != null) {
                $stmt->bindValue(':telefone', $dados->getusu_Telefone(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':telefone', $Usuario['usu_telefone'], PDO::PARAM_STR);
            }

            
            if ($dados->getusu_Email() != null) {
                $stmt->bindValue(':email', $dados->getusu_Email(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':email', $Usuario['usu_email'], PDO::PARAM_STR);
            }

            $stmt->bindValue(':senha', $hash);

            if ($dados->getusu_TipoUser() != null) {
                $stmt->bindValue(':tipo_user', $dados->getusu_TipoUser(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':tipo_user', $Usuario['usu_tipo'], PDO::PARAM_STR);
            }

            if ($dados->getusu_Endereco() != null) {
                $stmt->bindValue(':endereco', $dados->getusu_Endereco(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':endereco', $Usuario['usu_endereco'], PDO::PARAM_STR);
            }

            if ($dados->getusu_Numero() != null) {
                $stmt->bindValue(':numero', $dados->getusu_Numero(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':numero', $Usuario['usu_numero'], PDO::PARAM_STR);
            }

            if ($dados->getusu_Estado() != null) {
                $stmt->bindValue(':estado', $dados->getusu_Estado(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':estado', $Usuario['usu_estado'], PDO::PARAM_STR);
            }

            if ($dados->getusu_Cidade() != null) {
                $stmt->bindValue(':cidade', $dados->getusu_Cidade(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':cidade', $Usuario['usu_cidade'], PDO::PARAM_STR);
            }

            if ($dados->getusu_Complemento() != null) {
                $stmt->bindValue(':complemento', $dados->getusu_Complemento(), PDO::PARAM_STR);
            } else {
                $Usuario = $this->ObterUsuario($id);
                $stmt->bindValue(':complemento', $Usuario['usu_complemento'], PDO::PARAM_STR);
            }
            $stmt->execute();

            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function AlterarUsuarioPessoal($dados, $id)
    {
        try {

            $db = new Database();
            $this->conn = $db->getConnection();

            /* CRIPTOGRAFIA DA SENHA DO USUÁRIO */

            // var_dump($hash);exit();
            $sql = "UPDATE usuario SET 
            usu_nome = :nome, usu_cpf = :cpf, usu_telefone = :telefone, usu_email = :email,
            usu_endereco = :endereco, usu_numero = :numero,
            usu_estado = :estado, usu_cidade = :cidade, usu_complemento = :complemento
            WHERE usu_id = $id; ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $dados->getusu_Nome(), PDO::PARAM_STR);
            $stmt->bindValue(':cpf', $dados->getusu_Cpf(), PDO::PARAM_STR);
            $stmt->bindValue(':telefone', $dados->getusu_Telefone(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $dados->getusu_Email(), PDO::PARAM_STR);
            $stmt->bindValue(':endereco', $dados->getusu_Endereco(), PDO::PARAM_STR);
            $stmt->bindValue(':numero', $dados->getusu_Numero(), PDO::PARAM_STR);
            $stmt->bindValue(':estado', $dados->getusu_Estado(), PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $dados->getusu_Cidade(), PDO::PARAM_STR);
            $stmt->bindValue(':complemento', $dados->getusu_Complemento(), PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();

            $_SESSION['usuario_logado'] = $this->ObterUsuario($id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function ExcluirUsuario($id)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'UPDATE usuario SET usu_status = 0, usu_dt_exc = getDate() WHERE usu_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
