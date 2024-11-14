<?php


require_once("C:/xampp/htdocs/project/database/banco.php");


class ProdutoModel
{

    private $prod_id;
    private $prod_nome;
    private $prod_tipo;
    private $prod_custo;
    private $prod_venda;
    private $prod_descricao;
    private $prod_quantidade;
    private $prod_desconto;
    private $prod_imagem;
    private $prod_usuario;
    private $prod_dt_ini;
    private $prod_status;
    private $prod_dt_exc;

    private $conn;

    public function __construct($prod_id = null, $prod_nome = null, $prod_tipo_prod = null, $prod_custo = null, $prod_venda = null, $prod_descricao = null, $prod_quantidade = null, $prod_desconto = null, $prod_imagem = null, $prod_usuario = null,$prod_dt_ini = null, $prod_status = null, $prod_dt_exc = null)
    {
        $this->prod_id = $prod_id;
        $this->prod_nome = $prod_nome;
        $this->prod_tipo = $prod_tipo_prod;
        $this->prod_custo = $prod_custo;
        $this->prod_venda = $prod_venda;
        $this->prod_descricao = $prod_descricao;
        $this->prod_quantidade = $prod_quantidade;
        $this->prod_desconto = $prod_desconto;
        $this->prod_imagem = $prod_imagem;
        $this->prod_usuario = $prod_usuario;
        $this->prod_dt_ini = $prod_dt_ini;
        $this->prod_status = $prod_status;
        $this->prod_dt_exc = $prod_dt_exc;
    }

    public function getId()
    {
        return $this->prod_id;
    }
    public function setId($prod_id)
    {
        $this->prod_id = $prod_id;
    }

    public function getNome()
    {
        return $this->prod_nome;
    }
    public function setNome($prod_nome)
    {
        $this->prod_nome = $prod_nome;
    }
    public function getTipoProd()
    {
        return $this->prod_tipo;
    }
    public function setTipoProd($prod_tipo)
    {
        $this->prod_tipo = $prod_tipo;
    }

    public function getPrecoCusto()
    {
        return $this->prod_custo;
    }
    public function setPrecoCusto($prod_custo)
    {
        $this->prod_custo = $prod_custo;
    }
    public function getPrecoVenda()
    {
        return $this->prod_venda;
    }
    public function setPrecoVenda($prod_venda)
    {   
        $this->prod_venda = $prod_venda;
    }
    public function getDescricao()
    {
        return $this->prod_descricao;
    }
    public function setDescricao($prod_descricao)
    {
        $this->prod_descricao = $prod_descricao;
    }
    public function getQuantidade()
    {
        return $this->prod_quantidade;
    }
    public function setQuantidade($prod_quantidade)
    {
        $this->prod_quantidade = $prod_quantidade;
    }
    public function getDesconto()
    {
        return $this->prod_desconto;
    }
    public function setDesconto($prod_desconto)
    {
        $this->prod_desconto = $prod_desconto;
    }
    public function setImagem(string $imagem)
    {
        $this->prod_imagem = $imagem;
    }
    public function getImagem()
    {
        return $this->prod_imagem;
    }

    public function getImagemDiretorio(): string
    {
        return "../../public/img/uploads/" . $this->prod_imagem;
    }
    public function getProdUsuario()
    {
        return $this->prod_usuario;
    }
    public function setProdUsuario($prod_usuario)
    {
        $this->prod_usuario = $prod_usuario;
    }
    public function getDt_Cadastro()
    {
        return $this->prod_dt_ini;
    }
    public function setDt_Cadastro($prod_dt_ini)
    {
        $this->prod_dt_ini = $prod_dt_ini;
    }
    public function getStatus_produto()
    {
        return $this->prod_status;
    }
    public function setStatus_produto($prod_status)
    {
        $this->prod_status = $prod_status;
    }
    public function getDt_Exclusão()
    {
        return $this->prod_dt_exc;
    }
    public function setDt_Exclusão($prod_dt_exc)
    {
        $this->prod_dt_exc = $prod_dt_exc;
    }




    public function ListaProduto()
    {
        try{
            $db = new Database();
            $this->conn = $db->getConnection();
    
    
            $sql = " SELECT prod_id,
                        produtos.prod_nome, 
                        Tipos_Produtos.tipo_prod_nome,
                        produtos.prod_descricao, 
                        produtos.prod_custo, 
                        produtos.prod_venda, 
                        produtos.prod_desconto, 
                        produtos.prod_imagem, 
                        produtos.prod_dt_ini, 
                        usuario.usu_nome AS vendedor_nome
                    FROM 
                        produtos
                    INNER JOIN 
                        Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod  
                    INNER JOIN 
                        usuario ON produtos.prod_usu_cad = usuario.usu_id
                        WHERE prod_status = 1;
                    ";
            $stmt = $this->conn->query($sql);
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
    
            return $produtos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    public function ListaProdutoPorId($id)
    {

        try{
            $db = new Database();
            $this->conn = $db->getConnection();


            $sql = " SELECT prod_id,
                        produtos.prod_nome, 
                        Tipos_Produtos.tipo_prod_nome,
                        produtos.prod_descricao, 
                        produtos.prod_custo, 
                        produtos.prod_venda, 
                        produtos.prod_desconto, 
                        produtos.prod_imagem, 
                        produtos.prod_dt_ini, 
                        usuario.usu_nome AS vendedor_nome
                    FROM 
                        produtos
                    INNER JOIN 
                        Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod  
                    INNER JOIN 
                        usuario ON produtos.prod_usu_cad = usuario.usu_id
                        WHERE prod_usu_cad = :id AND prod_status = 1;
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $produtos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }




    public function ObterProduto($id)
    {
        try{
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = ' SELECT produtos.prod_nome, produtos.prod_tipo, produtos.prod_descricao, produtos.prod_custo, produtos.prod_venda, produtos.prod_desconto, produtos.prod_quantidade, produtos.prod_imagem FROM produtos
                        INNER JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod  
                        INNER JOIN usuario ON produtos.prod_usu_cad = usuario.usu_id
                        WHERE produtos.prod_id = :id AND prod_status = 1;
                    ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $produtos = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $produtos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function CadastrarProdutos(ProdutoModel $dados)
    {
        try{
            // var_dump($dados);exit();

            $db = new Database();
            $this->conn = $db->getConnection();

            $sql =
                "INSERT INTO produtos (prod_nome, prod_tipo, prod_custo, prod_venda, prod_descricao, prod_quantidade, prod_desconto, prod_imagem, prod_usu_cad, prod_dt_ini, prod_status, prod_dt_exc)
                            VALUES (:nome,:prod_tipo, :preco_custo, :preco_venda,:descricao, :quantidade, :desconto, :imagem,:prod_usuario, GETDATE(), 1, null);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":nome", $dados->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":prod_tipo", $dados->getTipoProd(), PDO::PARAM_STR);
            $stmt->bindValue(":preco_custo", $dados->getPrecoCusto(), PDO::PARAM_STR);
            $stmt->bindValue(":preco_venda", $dados->getPrecoVenda(), PDO::PARAM_STR);
            $stmt->bindValue(":descricao", $dados->getDescricao(), PDO::PARAM_STR);
            $stmt->bindValue(":desconto", $dados->getDesconto(), PDO::PARAM_STR);
            $stmt->bindValue(":quantidade", $dados->getQuantidade(), PDO::PARAM_STR);
            $stmt->bindValue(":imagem", $dados->getImagem(), PDO::PARAM_STR);
            $stmt->bindValue(":prod_usuario", $dados->getProdUsuario(), PDO::PARAM_STR);
            // var_dump($stmt->execute()); exit();
            $stmt->execute();
            $stmt->closeCursor();
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function AlterarProduto(ProdutoModel $dados, $idUsu, $idProd)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();


            $sql = "UPDATE produtos SET	prod_nome = :nome, prod_tipo = :prod_tipo, prod_custo = :preco_custo, prod_venda = :preco_venda, prod_descricao = :descricao, prod_desconto = :desconto, prod_quantidade = :quantidade, prod_imagem = :imagem, prod_usu_cad = :id_vendedor, prod_dt_ini = GETDATE() WHERE prod_id = $idProd";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":nome", $dados->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":prod_tipo", $dados->getTipoProd(), PDO::PARAM_STR);
            $stmt->bindValue(":preco_custo", $dados->getPrecoCusto(), PDO::PARAM_STR);
            $stmt->bindValue(":preco_venda", $dados->getPrecoVenda(), PDO::PARAM_STR);
            $stmt->bindValue(":descricao", $dados->getDescricao(), PDO::PARAM_STR);
            $stmt->bindValue(":desconto", $dados->getDesconto(), PDO::PARAM_STR);
            $stmt->bindValue(":quantidade", $dados->getQuantidade(), PDO::PARAM_STR);
            $stmt->bindValue(":imagem", $dados->getImagem(), PDO::PARAM_STR);
            $stmt->bindValue(":id_vendedor", $idUsu, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function ExcluirProduto($id)
    {
        try{
            $db = new Database();
            $this->conn = $db->getConnection();
    
    
            $sql = 'UPDATE produtos SET	prod_status = 0 WHERE prod_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $stmt->closeCursor();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
