<?php


require_once(dirname(__DIR__) . "/database/banco.php");


class ProdutoModel
{

    private $prod_id;
    private $prod_nome;
    private $prod_descricao;
    private $prod_imagem;
    private $prod_catPai;
    private $prod_catFilho;
    private $prod_marca;
    private $prod_tamanho;
    private $prod_estoque;
    private $prod_custo;
    private $prod_venda;
    private $prod_desconto;
    private $prod_avaliacao;
    private $prod_quantidadeVenda;
    private $prod_usuario;
    private $prod_dt_ini;
    private $prod_status;
    private $prod_dt_exc;

    private $conn;

    public function __construct($prod_id = null, $prod_nome = null, $prod_descricao = null, $prod_imagem = null, $prod_catPai = null, $prod_catFilho = null, $prod_marca = null, $prod_tamanho = null, $prod_estoque = null, $prod_custo = null, $prod_venda = null, $prod_desconto = null, $prod_avaliacao = null, $prod_quantidadeVenda = null, $prod_usuario = null, $prod_dt_ini = null, $prod_status = null, $prod_dt_exc = null)
    {
        $this->prod_id = $prod_id;
        $this->prod_nome = $prod_nome;
        $this->prod_descricao = $prod_descricao;
        $this->prod_imagem = $prod_imagem;
        $this->prod_catPai = $prod_catPai;
        $this->prod_catFilho = $prod_catFilho;
        $this->prod_marca = $prod_marca;
        $this->prod_tamanho = $prod_tamanho;
        $this->prod_estoque = $prod_estoque;
        $this->prod_custo = $prod_custo;
        $this->prod_venda = $prod_venda;
        $this->prod_desconto = $prod_desconto;
        $this->prod_avaliacao = $prod_avaliacao;
        $this->prod_quantidadeVenda = $prod_quantidadeVenda;
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
    public function getDescricao()
    {
        return $this->prod_descricao;
    }
    public function setDescricao($prod_descricao)
    {
        $this->prod_descricao = $prod_descricao;
    }
    public function getImagem()
    {
        return $this->prod_imagem;
    }
    public function setImagem(string $imagem)
    {
        $this->prod_imagem = $imagem;
    }
    public function getCor()
    {
        return $this->prod_cor;
    }
    public function setCor(string $cor)
    {
        $this->prod_cor = $cor;
    }
    public function getCatPai()
    {
        return $this->prod_catPai;
    }
    public function setCatPai(string $catPai)
    {
        $this->prod_catPai = $catPai;
    }
    public function getCatFilho()
    {
        return $this->prod_catFilho;
    }
    public function setCatFilho(string $catFilho)
    {
        $this->prod_catFilho = $catFilho;
    }
    public function getMarca()
    {
        return $this->prod_marca;
    }
    public function setMarca(string $marca)
    {
        $this->prod_marca = $marca;
    }
    public function getTamanho()
    {
        return $this->prod_tamanho;
    }
    public function setTamanho($prod_tamanho)
    {
        $this->prod_tamanho = $prod_tamanho;
    }
    public function getEstoque()
    {
        return $this->prod_estoque;
    }
    public function setEstoque($prod_estoque)
    {
        $this->prod_estoque = $prod_estoque;
    }
    public function getCusto()
    {
        return $this->prod_custo;
    }
    public function setCusto($prod_custo)
    {
        $this->prod_custo = $prod_custo;
    }
    public function getVenda()
    {
        return $this->prod_venda;
    }
    public function setVenda($prod_venda)
    {
        $this->prod_venda = $prod_venda;
    }
    public function getDesconto()
    {
        return $this->prod_desconto;
    }
    public function setDesconto($prod_desconto)
    {
        $this->prod_desconto = $prod_desconto;
    }
    public function getAvaliacao()
    {
        return $this->prod_avaliacao;
    }
    public function setAvaliacao($prod_avaliacao)
    {
        $this->prod_avaliacao = $prod_avaliacao;
    }
    public function getQuantidadeVenda()
    {
        return $this->prod_quantidadeVenda;
    }
    public function setQuantidadeVenda($prod_quantidadeVenda)
    {
        $this->prod_quantidadeVenda = $prod_quantidadeVenda;
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
    public function getImagemDiretorio(): string
    {
        return "../../public/img/uploads/" . $this->prod_imagem;
    }





    public function ListaAllProduto()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = " SELECT prod_id,
                        prod_nome,
                        prod_descricao,
                        prod_imagem,
                        prod_categoria_pai,
                        prod_categoria_filho,
                        prod_marca,
                        prod_tamanho,
                        prod_estoque,
                        prod_custo,
                        prod_venda,
                        prod_desconto,
                        prod_avaliacao,
                        prod_quantidadeVenda,
                        prod_usu_cad,
                        prod_dt_ini,
                        prod_status,
                        prod_dt_exc 
                        usuario.usu_nome AS vendedor_nome
                    FROM 
                        produtos
                    INNER JOIN 
                        usuario u ON produtos.prod_usu_cad = u.usu_id  
                    INNER JOIN
                        Categoria_Pai cp ON prod_categoria_pai = cp.catPai_id,
                        Categoria_Filho cf ON prod_categoria_filho = cf.catFilho_id,
                        Marca m ON prod_marca = m.marc_id,
                        WHERE prod_status = 1;
                    ";

            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);



            $stmt->closeCursor();

            return $produtos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function ExportCSVProdutos()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = " SELECT prod_id,
                        produtos.prod_nome, 
                        Tipos_Produtos.tipo_prod_nome,
                        produtos.prod_descricao, 
                        produtos.prod_custo, 
                        produtos.prod_venda, 
                        produtos.prod_quantidade,
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
            $stmt->execute();

            $stmt->closeCursor();

            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function ListaProduto($pag)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $limite = 8;
            $inicio = $pag * $limite;

            $sql = " SELECT prod_id,
                        prod_nome,
                        prod_descricao,
                        prod_imagem,
                        prod_categoria_pai,
                        prod_categoria_filho,
                        prod_marca,
                        prod_tamanho,
                        prod_estoque,
                        prod_custo,
                        prod_venda,
                        prod_desconto,
                        prod_avaliacao,
                        prod_quantidadeVenda,
                        prod_usu_cad,
                        prod_dt_ini,
                        prod_status,
                        prod_dt_exc 
                        usuario.usu_nome AS vendedor_nome
                    FROM 
                        produtos
                    INNER JOIN 
                        usuario u ON produtos.prod_usu_cad = u.usu_id  
                    INNER JOIN
                        Categoria_Pai cp ON prod_categoria_pai = cp.catPai_id,
                        Categoria_Filho cf ON prod_categoria_filho = cf.catFilho_id,
                        Marca m ON prod_marca = m.marc_id,
                        WHERE prod_status = 1;
                    ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":pagina", $inicio, PDO::PARAM_INT);
            $stmt->execute();

            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $produtos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function ListaProdutoPorId($id)
    {

        try {
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
                        WHERE prod_usu_cad = :id AND prod_status = 1 ORDER BY prod_id OFFSET 15 ROWS FETCH NEXT 5 ROWS ONLY;
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
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = ' SELECT prod_id, produtos.prod_nome, produtos.prod_tipo, produtos.prod_descricao, produtos.prod_custo, produtos.prod_venda, produtos.prod_desconto, produtos.prod_quantidade, produtos.prod_imagem FROM produtos
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
    public function ItemsAleatorios()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT TOP 3 *
                    FROM produtos WHERE prod_status = 1
                    ORDER BY NEWID();';
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $produtos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function CadastrarProdutos(ProdutoModel $dados)
    {
        try {
            // var_dump($dados);exit();

            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = "INSERT INTO produtos (
                        prod_nome,
                        prod_descricao,
                        prod_imagem,
                        prod_categoria_pai,
                        prod_categoria_filho,
                        prod_marca,
                        prod_tamanho,
                        prod_estoque,
                        prod_custo,
                        prod_venda,
                        prod_desconto,
                        prod_avaliacao,
                        prod_quantidadeVenda,
                        prod_usu_cad,
                        prod_dt_ini,
                        prod_status,
                        prod_dt_exc
                    ) VALUES (
                        :Nome,
                        :Descricao,
                        'null.png',
                        :Categoria_pai,
                        :Categoria_filho,
                        :Marca,
                        null,
                        :Estoque,
                        :Custo,
                        :Venda,
                        :Desconto,
                        null,
                        null,
                        :Usuario_cad,
                        GETDATE(),
                        1,
                        NULL
                    );";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":Nome", $dados->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":Descricao", $dados->getDescricao(), PDO::PARAM_STR);
            // $stmt->bindValue(":Imagem", $dados->getImagem(), PDO::PARAM_STR);
            $stmt->bindValue(":Categoria_pai", $dados->getCatPai(), PDO::PARAM_STR);
            $stmt->bindValue(":Categoria_filho", $dados->getCatFilho(), PDO::PARAM_STR);
            $stmt->bindValue(":Marca", $dados->getMarca(), PDO::PARAM_STR);
            // $stmt->bindValue(":Tamanho", $dados->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":Estoque", $dados->getEstoque(), PDO::PARAM_STR);
            $stmt->bindValue(":Custo", $dados->getCusto(), PDO::PARAM_STR);
            $stmt->bindValue(":Venda", $dados->getVenda(), PDO::PARAM_STR);
            $stmt->bindValue(":Desconto", $dados->getDesconto(), PDO::PARAM_STR);
            // $stmt->bindValue(":Avaliacao", $dados->getAvaliacao(), PDO::PARAM_STR);
            // $stmt->bindValue(":Quantidade_venda", $dados->getQuantidadeVenda(), PDO::PARAM_STR);
            $stmt->bindValue(":Usuario_cad", $dados->getProdUsuario(), PDO::PARAM_STR);

            // $stmt->debugDumpParams();
            // exit();
            $stmt->execute();

            $stmt->closeCursor();
        } catch (Exception $e) {
            echo "<pre>";
            var_dump($e);
            echo "</pre>";
            exit();
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
            if ($dados->getImagem() != null) {
                $stmt->bindValue(":imagem", $dados->getImagem(), PDO::PARAM_STR);
            } else {
                $produto = $this->ObterProduto($idProd);
                $stmt->bindValue(":imagem", $produto['prod_imagem'], PDO::PARAM_STR);
            }
            $stmt->bindValue(":id_vendedor", $idUsu, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function ExcluirProduto($id)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'UPDATE produtos SET	prod_status = 0, prod_dt_exc = getDate() WHERE prod_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function VerificarEstoque($id, $qtde)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT prod_nome, prod_quantidade, 
                    (CASE WHEN prod_quantidade > :qtde
                    THEN 1 ELSE 0 END) 
                    AS STATUS_PROD FROM produtos WHERE prod_id = :id;';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':qtde', $qtde, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function AtualizarQuantidade($id, $qntde)
    {
        try {
            // var_dump('AQUIII: ',$qntde);
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'UPDATE produtos set prod_quantidade = :qntdeAlterar where prod_id = :id;';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':qntdeAlterar', $qntde, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function PesquisaProdutos($produto)
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        try {

            $sql = "SELECT prod_id, 
                    produtos.prod_nome, 
                    Tipos_Produtos.tipo_prod_nome, 
                    produtos.prod_descricao, 
                    produtos.prod_custo, 
                    produtos.prod_venda, 
                    produtos.prod_quantidade, 
                    produtos.prod_desconto, 
                    produtos.prod_imagem, 
                    produtos.prod_dt_ini, 
                    usuario.usu_nome AS vendedor_nome
                    FROM produtos
                    INNER JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod  
                    INNER JOIN usuario ON produtos.prod_usu_cad = usuario.usu_id
                    WHERE produtos.prod_nome LIKE :produto";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':produto', '%' . $produto . '%', PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<div class='text-center alert alert-danger ' role='alert'>
                    <h4 class='alert-heading'> <span class='fas fa-exclamation-triangle'></span>  Atenção:</h4>
                    <hr/>
                    Erro de Consulta!
                    <h6>Notifique seu superior ou departamento de Tecnologia</h6>
                </div>";
            exit(); //NÃO DEIXA CONTINUAR A EXECUÇÃO
        }
    }
}
