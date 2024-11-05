<?php


require_once("C:/xampp/htdocs/project/back/database/banco.php");


class ProdutoModel
{

    private $id;
    private $nome;
    private $tipo_prod;
    private $preco_custo;
    private $preco_venda;
    private $descricao;
    private $desconto;
    private $imagem;
    private $id_vendedor;

    private $conn;

    public function __construct($id = null, $nome = null, $tipo_prod = null, $preco_custo = null, $preco_venda = null, $descricao = null, $desconto = null, $imagem = null, $id_vendedor = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo_prod = $tipo_prod;
        $this->preco_custo = $preco_custo;
        $this->preco_venda = $preco_venda;
        $this->descricao = $descricao;
        $this->desconto = $desconto;
        $this->imagem = $imagem;
        $this->id_vendedor = $id_vendedor;


    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTipoProd()
    {
        return $this->tipo_prod;
    }

    public function getPrecoCusto()
    {
        return $this->preco_custo;
    }

    public function getPrecoVenda()
    {
        return $this->preco_venda;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getDesconto()
    {
        return $this->desconto;
    }
    public function setImagem(string $imagem)
    {
        $this->imagem = $imagem;
    }


    public function getImagem()
    {
        return $this->desconto;
    }

    public function getImagemDiretorio(): string
    {
        return "../../public/img/" . $this->imagem;
    }
    public function getIdVendedor()
    {
        return $this->id_vendedor;
    }



    public function ListarProdutos(): array
    {

        $db = new Database();
        $this->conn = $db->getConnection();

        
        $sql = " SELECT *, usuarios.nome as vendedor_nome, produtos.nome as nome_prod FROM produtos
                    INNER JOIN Tipos_Produtos ON produtos.tipo_prod = Tipos_Produtos.id_tipo_prod  
                    INNER JOIN usuarios ON produtos.id_vendedor = usuarios.id_usuario;
                ";
        $stmt = $this->conn->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $stmt->closeCursor();

        return $produtos;
    }

    public function ObterProduto($id): array
    {

        $db = new Database();
        $this->conn = $db->getConnection();

        
        $sql = " SELECT *, usuarios.nome as vendedor_nome, produtos.nome as nome_prod FROM produtos
                    INNER JOIN Tipos_Produtos ON produtos.tipo_prod = Tipos_Produtos.id_tipo_prod  
                    INNER JOIN usuarios ON produtos.id_vendedor = usuarios.id_usuario
                    WHERE produtos.id_produto = $id;
                ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $produtos = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $produtos;
    }

    public function CadastrarProdutos(ProdutoModel $dados)
    {

        $db = new Database();
        $this->conn = $db->getConnection();

        
        // var_dump( $dados );
        $sql =
            "INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto,imagem, id_vendedor)
            VALUES              (:nome,:tipo_prod, :preco_custo,:preco_venda,:descricao,:desconto,:imagem,:id_vendedor);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $dados->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(":tipo_prod", $dados->getTipoProd(), PDO::PARAM_STR);
        $stmt->bindValue(":descricao", $dados->getDescricao(), PDO::PARAM_STR);
        $stmt->bindValue(":imagem", $dados->getImagem(), PDO::PARAM_STR);
        $stmt->bindValue(":preco_custo", $dados->getPrecoCusto(), PDO::PARAM_STR);
        $stmt->bindValue(":preco_venda", $dados->getPrecoVenda(), PDO::PARAM_STR);
        $stmt->bindValue(":desconto", $dados->getDesconto(), PDO::PARAM_STR);
        $stmt->bindValue(":id_vendedor", $dados->getIdVendedor(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function AlterarProduto(ProdutoModel $dados, $id){

        $db = new Database();
        $this->conn = $db->getConnection();

        
        $sql = "UPDATE produtos SET	nome = :nome, tipo_prod = :tipo_prod, preco_custo = :preco_custo, preco_venda = :preco_venda, descricao = :descricao, desconto = :desconto, imagem = :imagem, id_vendedor = :id_vendedor WHERE id_produto = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $dados->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(":tipo_prod", $dados->getTipoProd(), PDO::PARAM_STR);
        $stmt->bindValue(":descricao", $dados->getDescricao(), PDO::PARAM_STR);
        $stmt->bindValue(":imagem", $dados->getImagem(), PDO::PARAM_STR);
        $stmt->bindValue(":preco_custo", $dados->getPrecoCusto(), PDO::PARAM_STR);
        $stmt->bindValue(":preco_venda", $dados->getPrecoVenda(), PDO::PARAM_STR);
        $stmt->bindValue(":desconto", $dados->getDesconto(), PDO::PARAM_STR);
        $stmt->bindValue(":id_vendedor", $dados->getIdVendedor(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function ExcluirProduto($id)
    {

        $db = new Database();
        $this->conn = $db->getConnection();

        
        $sql = "DELETE FROM produtos WHERE id_produto = $id";
        var_dump($sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $stmt->closeCursor();
    }
}
