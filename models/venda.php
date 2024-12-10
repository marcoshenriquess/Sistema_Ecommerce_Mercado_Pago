<?php
require_once(dirname(__DIR__) . "/database/banco.php");

class VendaModel
{
    public $ven_id;
    public $ven_prod_id;
    public $ven_usu_id;
    public $ven_quantidade;
    public $ven_valor;
    public $conn;

    public function __construct($ven_id = null, $ven_prod_id = null, $ven_usu_id = null, $ven_quantidade = null, $ven_valor = null)
    {
        $this->ven_id = $ven_id;
        $this->ven_prod_id = $ven_prod_id;
        $this->ven_usu_id = $ven_usu_id;
        $this->ven_quantidade = $ven_quantidade;
        $this->ven_valor = $ven_valor;
    }

    public function getIdVenda()
    {
        return $this->ven_id;
    }
    public function setIdVenda($ven_id)
    {
        $this->ven_id = $ven_id;
    }
    public function getProdutoId()
    {
        return $this->ven_prod_id;
    }
    public function setProdutoId($ven_prod_id)
    {
        $this->ven_prod_id = $ven_prod_id;
    }
    public function getUsuarioId()
    {
        return $this->ven_usu_id;
    }
    public function setUsuarioId($ven_usu_id)
    {
        $this->ven_usu_id = $ven_usu_id;
    }
    public function getQuantidade()
    {
        return $this->ven_quantidade;
    }
    public function setQuantidade($ven_quantidade)
    {
        $this->ven_quantidade = $ven_quantidade;
    }
    public function getValor()
    {
        return $this->ven_valor;
    }
    public function setValor($ven_valor)
    {
        $this->ven_valor = $ven_valor;
    }

    public function ObeterVendaIdUsu($id)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT DISTINCT
                    prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt, cod_venda,ven_id
                    FROM venda
                    INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
                    INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id where ven_usu_id = :id ORDER BY ven_id DESC;';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ObeterVenda($id)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT cod_venda FROM venda WHERE cod_venda = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ObterAllVenda()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT 
                    prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt, cod_venda
                    FROM venda
                    INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
                    INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id ORDER BY ven_dt DESC;';
                    
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();
            
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ObterPagVenda($pag)
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            
            $limite = 8;
            $inicio = $pag * $limite;

            $sql = 'SELECT 
                    prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt, cod_venda
                    FROM venda
                    INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
                    INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id ORDER BY ven_dt DESC OFFSET :pagina ROWS FETCH NEXT 8 ROWS ONLY;';
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":pagina", $inicio, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();
            
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function CadastrarVenda($id_prod, $user, $quantidade, $valor, $codigo_venda)
    {
        try {
            // var_dump($codigo_venda);

            $VentaValor = $quantidade * $valor;

            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'INSERT INTO Venda (ven_prod_id, ven_usu_id, ven_quantidade, ven_valor, cod_venda, ven_dt) values (:id_prod,:id_usu,:quantidade,:valor, :cod_venda, GETDATE())';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id_prod', $id_prod, PDO::PARAM_INT);
            $stmt->bindValue(':id_usu', $user, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(':valor', $valor, PDO::PARAM_INT);
            $stmt->bindValue(':cod_venda', $codigo_venda, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $stmt;
    }

    public function TotalValorVendaProd()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT p.prod_nome, SUM(ven_valor) as TOTAL, ven_quantidade, ven_prod_id as id from venda
                    INNER JOIN produtos as p ON venda.ven_prod_id = p.prod_id
                    GROUP BY p.prod_nome, ven_prod_id, ven_quantidade;';
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function MediaValorVendaNoAno()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT 
                        MONTH(ven_dt) AS Mes, 
                        AVG(ven_valor) AS Media_Anual
                    FROM 
                        venda
                    GROUP BY 
                        MONTH(ven_dt)
                    ORDER BY 
                        Mes;';
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ConsultaDados()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT tipo_prod_nome, SUM(ven_quantidade) as Quantidade from produtos
                    INNER JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod
                    INNER JOIN (SELECT * from venda) Venda on Venda.ven_prod_id = produtos.prod_id
                    GROUP BY tipo_prod_nome ORDER BY Quantidade DESC;';
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ConsultaValorVendaMes()
    {
        try {
            $db = new Database();
            $this->conn = $db->getConnection();

            $sql = 'SELECT DATENAME(month, ven_dt) AS Mes, YEAR(ven_dt) AS Ano, SUM(ven_quantidade) AS ProdutosVendidos FROM venda
                    WHERE YEAR(ven_dt) = YEAR(GETDATE())
                    GROUP BY YEAR(ven_dt), DATENAME(month, ven_dt),  MONTH(ven_dt)
                    ORDER BY MONTH(ven_dt) ASC;';
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
