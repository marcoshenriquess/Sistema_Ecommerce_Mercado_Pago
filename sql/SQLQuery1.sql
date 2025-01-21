USE LOJA_ESPORTIVA;

CREATE TABLE Categoria_Pai(
	catPai_id INT IDENTITY(1,1) primary key,
	catPai_nome varchar(100) NOT NULL
);

CREATE TABLE Esporte(
	esp_id INT IDENTITY(1,1) primary key,
	esp_nome varchar(100) NOT NULL
);

CREATE TABLE Times(
	time_id INT IDENTITY(1,1) primary key,
	time_nome varchar(130) NOT NULL,
);

CREATE TABLE Categoria_Filho(
	catFilho_id INT IDENTITY(1,1) primary key,
	catFilho_nome varchar(100) NOT NULL,
	catFilho_catPai INT NOT NULL,
	catFilho_esporte INT NULL,
	FOREIGN KEY (catFilho_catPai) REFERENCES Categoria_Pai(catPai_id),
	FOREIGN KEY (catFilho_esporte) REFERENCES Esporte(esp_id),
);

CREATE TABLE Carrinho(
	car_id INT IDENTITY(1,1) PRIMARY KEY,
	car_valor DECIMAL(10, 2) NOT NULL,
	car_usu_id INT NOT NULL,
	car_prod_id INT NOT NULL,
	FOREIGN KEY (car_usu_id) REFERENCES usuario(usu_id),
	FOREIGN KEY (car_prod_id) REFERENCES produtos(prod_id),
);

CREATE TABLE Tipos_Users (
    id_tipo_user INT IDENTITY(1,1) PRIMARY KEY,
    tipo_user_nome VARCHAR(20) NOT NULL
);

CREATE TABLE Tipos_Produtos (
    id_tipo_prod INT IDENTITY(1,1) PRIMARY KEY,
    tipo_prod_nome VARCHAR(90) NOT NULL
);

CREATE TABLE Estado (
    id_estado INT IDENTITY(1,1) PRIMARY KEY,
    nome_estado VARCHAR(2) NOT NULL
);

CREATE TABLE Venda(
	ven_id INT IDENTITY(1,1) PRIMARY KEY,
	ven_prod_id INT NOT NULL,
	ven_usu_id INT NOT NULL,
	ven_quantidade INT NOT NULL,
	ven_valor DECIMAL(10,2) NOt NULL,
	FOREIGN KEY (ven_usu_id) REFERENCES usuario(usu_id),
	FOREIGN KEY (ven_prod_id) REFERENCES produtos(prod_id),
);

CREATE TABLE Marca (
    marc_id INT IDENTITY(1,1) PRIMARY KEY,
    marc_nome VARCHAR(100) NOT NULL
);

CREATE TABLE usuario (
    usu_id INT IDENTITY(1,1) PRIMARY KEY,
    usu_nome VARCHAR(150) NOT NULL,
    usu_cpf CHAR(11) NOT NULL UNIQUE,
    usu_telefone VARCHAR(15) NOT NULL UNIQUE,
    usu_email VARCHAR(150) NOT NULL UNIQUE,
    usu_senha VARCHAR(150) NOT NULL,
    usu_tipo INT NOT NULL, -- Tipo de usuário referenciando a tabela Tipos_Users
    usu_endereco VARCHAR(200) NOT NULL,
	usu_numero VARCHAR(20) NOT NULL,
    usu_estado int NOT NULL,
    usu_cidade int NOT NULL,
    usu_complemento VARCHAR(150) NOT NULL,
	usu_dt_ini DATE NOT NULL,
	usu_usu_status bit NOT NULL,
	usu_dt_exc DATE NULL,
    FOREIGN KEY (usu_tipo) REFERENCES Tipos_Users(id_tipo_user),
	FOREIGN KEY (usu_estado) REFERENCES Estado(id_estado),
	FOREIGN KEY (usu_cidade) REFERENCES Cidade(id_cidade),
);

CREATE TABLE produtos (
    prod_id INT IDENTITY(1,1) PRIMARY KEY,
    prod_nome VARCHAR(150) NOT NULL,
    prod_descricao TEXT NULL,
    prod_imagem VARCHAR(255) NULL,
	prod_categoria_pai INT NOT NULL,
    prod_categoria_filho INT NOT NULL, 
	prod_marca INT NULL,
	prod_tamanho VARCHAR(100) NULL,
	prod_estoque INT null,
    prod_custo DECIMAL(10, 2) NOT NULL,
    prod_venda DECIMAL(10, 2) NOT NULL,
    prod_desconto DECIMAL(5, 2) null,
	prod_avaliacao DECIMAL(2, 1) null ,
	prod_quantidadeVenda INT null,
    prod_usu_cad INT NOT NULL,
	prod_dt_ini DATE NOT NULL,
	prod_status bit NOT NULL,
	prod_dt_exc DATE NULL,
    FOREIGN KEY (prod_usu_cad) REFERENCES usuario(usu_id),
    FOREIGN KEY (prod_categoria_pai) REFERENCES Categoria_Pai(catPai_id),
    FOREIGN KEY (prod_categoria_filho) REFERENCES Categoria_Filho(catFilho_id),
    FOREIGN KEY (prod_marca) REFERENCES Marca(marc_id),
);

-- ESPORTES --
INSERT INTO Esporte (esp_nome) VALUES ('Basquete');
INSERT INTO Esporte (esp_nome) VALUES ('Futebol');
INSERT INTO Esporte (esp_nome) VALUES ('Tênis');
INSERT INTO Esporte (esp_nome) VALUES ('Baseball');
INSERT INTO Esporte (esp_nome) VALUES ('Futebol Americano');
INSERT INTO Esporte (esp_nome) VALUES ('Natação');
INSERT INTO Esporte (esp_nome) VALUES ('Corrida');
INSERT INTO Esporte (esp_nome) VALUES ('Trilha');
INSERT INTO Esporte (esp_nome) VALUES ('Trekking');
INSERT INTO Esporte (esp_nome) VALUES ('Vôlei');
INSERT INTO Esporte (esp_nome) VALUES ('Golfe');

-- TIMES --
INSERT INTO Times (time_nome) VALUES ('Los Angeles Lakers');
INSERT INTO Times (time_nome) VALUES ('Chicago Bulls');
INSERT INTO Times (time_nome) VALUES ('Golden State Warriors');

INSERT INTO Times (time_nome) VALUES ('Barcelona');
INSERT INTO Times (time_nome) VALUES ('Real Madrid');
INSERT INTO Times (time_nome) VALUES ('Manchester United');

INSERT INTO Times (time_nome) VALUES ('Novak Djokovic Team');
INSERT INTO Times (time_nome) VALUES ('Roger Federer Team');
INSERT INTO Times (time_nome) VALUES ('Rafael Nadal Team');

INSERT INTO Times (time_nome) VALUES ('New York Yankees');
INSERT INTO Times (time_nome) VALUES ('Los Angeles Dodgers');
INSERT INTO Times (time_nome) VALUES ('Boston Red Sox');

INSERT INTO Times (time_nome) VALUES ('New England Patriots');
INSERT INTO Times (time_nome) VALUES ('Dallas Cowboys');
INSERT INTO Times (time_nome) VALUES ('San Francisco 49ers');

INSERT INTO Times (time_nome) VALUES ('Michael Phelps Team');
INSERT INTO Times (time_nome) VALUES ('Katie Ledecky Team');
INSERT INTO Times (time_nome) VALUES ('Caeleb Dressel Team');

INSERT INTO Times (time_nome) VALUES ('Salomon Trail Runners');
INSERT INTO Times (time_nome) VALUES ('The North Face Explorers');
INSERT INTO Times (time_nome) VALUES ('Columbia Trekking Club');

INSERT INTO Times (time_nome) VALUES ('Brazil Volleyball Team');
INSERT INTO Times (time_nome) VALUES ('USA Volleyball Team');
INSERT INTO Times (time_nome) VALUES ('Russia Volleyball Team');

INSERT INTO Times (time_nome) VALUES ('Tiger Woods Team');
INSERT INTO Times (time_nome) VALUES ('Rory McIlroy Team');
INSERT INTO Times (time_nome) VALUES ('Phil Mickelson Team');

-- Categoria PAI --
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Roupas Esportivas');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Calçados Esportivos');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Acessórios Esportivos');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Acessórios de Esportes');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Esportes Outdoor');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Suplementação e Nutrição');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Esportes de Inverno');
INSERT INTO Categoria_Pai (catPai_nome) VALUES ('Acessórios de Saúde e Bem-Estar');

-- Categoria Filho -- 
-- Roupas Esportivas
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Camisetas Dry Fit', 1);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Shorts de Corrida', 1);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Leggings Fitness', 1);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Casacos de Treino', 1);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Regatas para Academia', 1);

-- Calçados Esportivos
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Tênis de Corrida', 2);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Chuteiras de Futebol', 2);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Botas de Hiking', 2);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Tênis para Basquete', 2);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Tênis de Treino', 2);

-- Acessórios Esportivos
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Luvas de Musculação', 3);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Cintos de Levantamento', 3);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Munhequeiras de Suporte', 3);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Bandanas para Esporte', 3);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Meias Compressivas', 3);

-- Acessórios de Esportes
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Bolas de Futebol', 4);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Raquetes de Tênis', 4);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Capacetes para Ciclismo', 4);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Óculos de Natação', 4);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Pranchas de Surf', 4);

-- Esportes Outdoor
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Barracas de Camping', 5);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Mochilas para Hiking', 5);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Garrafas Térmicas', 5);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Lanternas Portáteis', 5);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Mapas e Guias de Trilhas', 5);

-- Suplementação e Nutrição
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Whey Protein', 6);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Creatina', 6);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Barras de Proteína', 6);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Vitaminas e Minerais', 6);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('BCAAs', 6);

-- Esportes de Inverno
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Jaquetas de Esqui', 7);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Luvas Térmicas', 7);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Capacetes de Snowboard', 7);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Óculos de Neve', 7);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Botas de Neve', 7);

-- Acessórios de Saúde e Bem-Estar
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Faixas Elásticas', 8);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Monitores de Freqüência Cardíaca', 8);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Rolos de Liberação Miofascial', 8);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Balanças Inteligentes', 8);
INSERT INTO Categoria_Filho (catFilho_nome, catFilho_catPai) VALUES ('Bolsas de Gelo', 8);


-- MARCAS --
INSERT INTO Marca (marc_nome) VALUES ('Adidas');
INSERT INTO Marca (marc_nome) VALUES ('Puma');
INSERT INTO Marca (marc_nome) VALUES ('Reebok');
INSERT INTO Marca (marc_nome) VALUES ('Under Armour');
INSERT INTO Marca (marc_nome) VALUES ('Asics');
INSERT INTO Marca (marc_nome) VALUES ('New Balance');
INSERT INTO Marca (marc_nome) VALUES ('Fila');
INSERT INTO Marca (marc_nome) VALUES ('Mizuno');
INSERT INTO Marca (marc_nome) VALUES ('Columbia');
INSERT INTO Marca (marc_nome) VALUES ('The North Face');
INSERT INTO Marca (marc_nome) VALUES ('Salomon');
INSERT INTO Marca (marc_nome) VALUES ('Champion');
INSERT INTO Marca (marc_nome) VALUES ('Wilson');
INSERT INTO Marca (marc_nome) VALUES ('Spalding');
INSERT INTO Marca (marc_nome) VALUES ('Umbro');
INSERT INTO Marca (marc_nome) VALUES ('Lotto');
INSERT INTO Marca (marc_nome) VALUES ('Kappa');
INSERT INTO Marca (marc_nome) VALUES ('Everlast');
INSERT INTO Marca (marc_nome) VALUES ('Decathlon');
INSERT INTO Marca (marc_nome) VALUES ('Oakley');



SELECT catFilho_nome, catPai_nome ,esp_nome FROM Categoria_Filho CF
INNER JOIN Categoria_Pai CP ON CF.catFilho_catPai = CP.catPai_id
INNER JOIN Esporte EP ON CF.catFilho_esporte = EP.esp_id;

SELECT * FROM Categoria_Pai;
	SELECT * FROM Categoria_Filho;
	SELECT * FROM produtos;
SELECT * FROM Marca
SELECT * FROM Esporte;

select * from Categoria_Filho where catFilho_catPai = 6;

DELETE FROM Categoria_Filho WHERE catFilho_catPai = 3;

-- Inserindo registros na tabela Tipos_users
insert into Tipos_Users (tipo_user_nome) values ('Administrador');
insert into Tipos_Users (tipo_user_nome) values ('Vendedor');
insert into Tipos_Users (tipo_user_nome) values ('Cliente');

INSERT INTO produtos (
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
                        'TEste',
                        'TEste',
                        'null.png',
                        1,
                        30,
                        1,
                        null,
                        12,
                        12,
                        12,
                        12,
                        null,
                        null,
                        11,
                        GETDATE(),
                        1,
                        NULL
                    );

-- Inserindo registros na tabela usuarios
-- Cliente 1
INSERT INTO usuario 
(usu_nome, usu_cpf, usu_telefone, usu_email, usu_senha, usu_tipo, usu_endereco, usu_numero, usu_estado, usu_cidade, usu_complemento, usu_dt_ini, usu_status, usu_dt_exc) 
VALUES 
('Carlos Silva', '12345678901', '(11) 91234-5678', 'carlos.silva@gmail.com', 'senhaSegura123', 2, 
'Rua das Flores', '100', 25, 1, 'Apto 101', 
GETDATE(), 1, NULL);

-- Cliente 2
INSERT INTO usuario 
(usu_nome, usu_cpf, usu_telefone, usu_email, usu_senha, usu_tipo, usu_endereco, usu_numero, usu_estado, usu_cidade, usu_complemento, usu_dt_ini, usu_status, usu_dt_exc) 
VALUES 
('admin', '98765432100', '(21) 92345-6789', 'admin@admin.com', 'admin0000', 1, 
'Avenida Brasil', '2500', 19, 2, 'Bloco B', 
GETDATE(), 1, NULL);

-- Cliente 3
INSERT INTO usuario 
(usu_nome, usu_cpf, usu_telefone, usu_email, usu_senha, usu_tipo, usu_endereco, usu_numero, usu_estado, usu_cidade, usu_complemento, usu_dt_ini, usu_status, usu_dt_exc) 
VALUES 
('João Souza', '12312312312', '(31) 93456-7890', 'joao.souza@hotmail.com', '', 1, 
'Rua do Comércio', '200', 13, 3, 'Casa 2', 
GETDATE(), 1, NULL);

-- Cliente 4
INSERT INTO usuario 
(usu_nome, usu_cpf, usu_telefone, usu_email, usu_senha, usu_tipo, usu_endereco, usu_numero, usu_estado, usu_cidade, usu_complemento, usu_dt_ini, usu_status, usu_dt_exc) 
VALUES 
('Ana Paula Lima', '32132132132', '(71) 94567-8901', 'ana.paula@gmail.com', 'senhaAna123', 3, 
'Rua das Palmeiras', '50', 5, 4, 'Perto da praça', 
GETDATE(), 1, NULL);

-- Função usada para Login
SELECT * FROM usuario WHERE usu_email = 'joao.souza@hotmail.com' AND usu_senha = 'minhaSenha789' AND usu_status = 1;


-- Inserindo registros na tabela produtos e os Tipos

INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Roupas Esportivas');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Blusas');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Artigos Esportivos');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Bonés');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Calçados');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Acessórios de Inverno');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Mochilas');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Suplementos');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Equipamentos de Camping');
INSERT INTO Tipos_Produtos (tipo_prod_nome) VALUES ('Equipamentos de Academia');

INSERT INTO produtos (nome,descricao, tipo_prod, preco_custo, preco_venda,  desconto, imagem, id_vendedor) 
VALUES ('Camiseta Esportiva da Nike', 'Camiseta leve e respirável, ideal para atividades físicas.', 1, 50.00, 70.00,  NULL, 'camiseta_esportiva.jpg', 1);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Bola de Futebol', 3, 120.00, 150.00, 'Bola de futebol profissional com garantia de qualidade.', NULL, 'bola_futebol.jpg', 2);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Boné Adidas', 4, 30.00, 50.00, 'Boné estiloso da Adidas, perfeito para atividades ao ar livre.', NULL, 'bone_adidas.jpg', 1);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Tênis de Corrida', 5, 200.00, 300.00, 'Tênis de corrida com amortecimento e suporte ao pé.', 10.00, 'tenis_corrida.jpg', 2);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Mochila para Hiking', 7, 80.00, 120.00, 'Mochila resistente, ideal para caminhadas e aventuras ao ar livre.', NULL, 'mochila_hiking.jpg', 1);




-- INSERINDO DADOS NA TABELA ESTADO E CIDADE

INSERT INTO Estado (nome_estado) VALUES 
('AC'), -- Acre
('AL'), -- Alagoas
('AP'), -- Amapá
('AM'), -- Amazonas
('BA'), -- Bahia
('CE'), -- Ceará
('DF'), -- Distrito Federal
('ES'), -- Espírito Santo
('GO'), -- Goiás
('MA'), -- Maranhão
('MT'), -- Mato Grosso
('MS'), -- Mato Grosso do Sul
('MG'), -- Minas Gerais
('PA'), -- Pará
('PB'), -- Paraíba
('PR'), -- Paraná
('PE'), -- Pernambuco
('PI'), -- Piauí
('RJ'), -- Rio de Janeiro
('RN'), -- Rio Grande do Norte
('RS'), -- Rio Grande do Sul
('RO'), -- Rondônia
('RR'), -- Roraima
('SC'), -- Santa Catarina
('SP'), -- São Paulo
('SE'), -- Sergipe
('TO'); -- Tocantins


-- Cidades de São Paulo (SP)
INSERT INTO Cidade (nome_cidade) VALUES 
('São Paulo'), 
('Campinas'), 
('Santos'), 
('São Bernardo do Campo'), 
('Ribeirão Preto');

-- Cidades do Rio de Janeiro (RJ)
INSERT INTO Cidade (nome_cidade) VALUES 
('Rio de Janeiro'), 
('Niterói'), 
('Duque de Caxias'), 
('Nova Iguaçu'), 
('Petrópolis');

-- Cidades de Minas Gerais (MG)
INSERT INTO Cidade (nome_cidade) VALUES 
('Belo Horizonte'), 
('Uberlândia'), 
('Juiz de Fora'), 
('Contagem'), 
('Betim');

-- Cidades da Bahia (BA)
INSERT INTO Cidade (nome_cidade) VALUES 
('Salvador'), 
('Feira de Santana'), 
('Vitória da Conquista'), 
('Camaçari'), 
('Ilhéus')

select * from usuario;


 


DELETE from produtos where prod_id = 9;

INSERT INTO produtos 
(prod_nome, 
prod_tipo, 
prod_custo, 
prod_venda, 
prod_descricao, 
prod_quantidade, 
prod_desconto, 
prod_imagem, 
prod_usu_cad, 
prod_dt_ini, 
prod_status, 
prod_dt_exc) 
VALUES 
-- Produto 1
('Camiseta Básica', 1, 20.00, 39.99, 'Camiseta de algodão, disponível em várias cores.', 100, 10.00, 'camiseta_basica.jpg', 1, GETDATE(), 1, NULL);

-- Produto 2
('Calça Jeans', 2, 50.00, 99.99, 'Calça jeans com corte reto e acabamento de alta qualidade.', 50, 5.00, 'calca_jeans.jpg', 2, GETDATE(), 1, NULL),

-- Produto 3
('Tênis Esportivo', 3, 120.00, 199.99, 'Tênis esportivo leve e confortável, ideal para corridas.', 75, 15.00, 'tenis_esportivo.jpg', 3, GETDATE(), 1, NULL),

-- Produto 4
('Relógio Digital', 4, 70.00, 149.99, 'Relógio digital com diversas funcionalidades e design moderno.', 30, 20.00, 'relogio_digital.jpg', 4, GETDATE(), 1, NULL),

-- Produto 5
('Mochila Escolar', 5, 40.00, 79.99, 'Mochila com compartimentos múltiplos, ideal para uso escolar.', 120, 0.00, 'mochila_escolar.jpg', 1, GETDATE(), 1, NULL);




SELECT usu_id,usu_nome,usu_email,Tipos_Users.tipo_user_nome,Cidade.nome_cidade,Estado.nome_estado, usu_status,usu_cpf FROM usuario 
        INNER JOIN Tipos_Users ON usuario.usu_tipo = Tipos_Users.id_tipo_user
        INNER JOIN Cidade ON usuario.usu_cidade = Cidade.id_cidade
        INNER JOIN Estado ON usuario.usu_estado = Estado.id_Estado;

		select * from produtos;


select * from usuario;


SELECT Cidade.nome_cidade, COUNT(*) as NumeroClientes FROM usuario
INNER JOIN Cidade ON usuario.usu_cidade = Cidade.id_cidade
GROUP BY Cidade.nome_cidade;


SELECT p.prod_nome, SUM(ven_valor) as TOTAL, ven_quantidade, ven_prod_id as Total from venda
INNER JOIN produtos as p ON venda.ven_prod_id = p.prod_id
GROUP BY p.prod_nome, ven_prod_id, ven_quantidade;


select * from venda;

SELECT Tipos_Produtos.tipo_prod_nome, COUNT(*) as Quantidade_de_produtos FROM produtos
LEFT JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod
where prod_status = 1
GROUP BY Tipos_Produtos.tipo_prod_nome;

select prod_nome, prod_tipo, Tipos_Produtos.tipo_prod_nome from produtos 
LEFT JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod;

SELECT * FROM produtos INNER JOIN usuario ON prod_usu_cad = usuario.usu_id;
SELECT * FROM produtos FULL JOIN usuario ON prod_usu_cad = usuario.usu_id;
SELECT * FROM produtos LEFT JOIN usuario ON prod_usu_cad = usuario.usu_id;
SELECT * FROM produtos RIGHT JOIN usuario ON prod_usu_cad = usuario.usu_id;

SELECT prod_nome, prod_quantidade 
            FROM produtos 
            WHERE prod_quantidade >= 11 AND prod_id = 30;

SELECT prod_nome, prod_quantidade, 
                    (CASE WHEN prod_quantidade >= 50
                    THEN 1 ELSE 0 END) 
                    AS STATUS_PROD FROM produtos WHERE prod_id = 29;



select * from produtos where prod_id = 31;


INSERT INTO Venda (ven_prod_id, ven_usu_id, ven_quantidade, ven_valor) values (29,12,5,100);

SELECT 
 prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt
FROM venda
INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id;


select * from venda where ven_usu_id = 12 ORDER BY ven_id DESC
DELETE FROM venda where ven_usu_id = 12;

TRUNCATE TABLE Venda;

use LOJA_ESPORTIVA;

SELECT prod_id, produtos.prod_nome, produtos.prod_tipo, produtos.prod_descricao, produtos.prod_custo, produtos.prod_venda, produtos.prod_desconto, produtos.prod_quantidade, produtos.prod_imagem FROM produtos
                        INNER JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod  
                        INNER JOIN usuario ON produtos.prod_usu_cad = usuario.usu_id
                        WHERE produtos.prod_id = 31 AND prod_status = 1;







SELECT p.prod_nome, SUM(ven_valor) as TOTAL, ven_quantidade, ven_prod_id as id from venda
                    INNER JOIN produtos as p ON venda.ven_prod_id = p.prod_id
                    GROUP BY p.prod_nome, ven_prod_id, ven_quantidade;


select * from Tipos_Produtos;

SELECT prod_nome, SUM(ven_quantidade) as Quantidade from venda
INNER JOIN produtos ON venda.ven_prod_id = prod_id
group by prod_nome ORDER BY Quantidade DESC;


select tipo_prod_nome, SUM(ven_quantidade) as Quantidade from produtos
INNER JOIN Tipos_Produtos ON produtos.prod_tipo = Tipos_Produtos.id_tipo_prod
INNER JOIN (SELECT * from venda) Venda on Venda.ven_prod_id = produtos.prod_id
GROUP BY tipo_prod_nome ORDER BY Quantidade DESC;

SELECT p.prod_nome, SUM(ven_valor) as TOTAL, ven_quantidade, ven_prod_id as id from venda
INNER JOIN produtos as p ON venda.ven_prod_id = p.prod_id
GROUP BY p.prod_nome, ven_prod_id, ven_quantidade;

SELECT DATENAME(month, ven_dt) AS Mes, YEAR(ven_dt) AS Ano, SUM(ven_quantidade) AS ProdutosVendidos FROM venda
                    GROUP BY YEAR(ven_dt), DATENAME(month, ven_dt),  MONTH(ven_dt)
                    ORDER BY MONTH(ven_dt) ASC;

SELECT 
    DATENAME(month, ven_dt) AS Mes,
    YEAR(ven_dt) AS Ano,
    SUM(ven_valor) AS Total_Mes
FROM 
    venda
GROUP BY 
    DATENAME(month, ven_dt), YEAR(ven_dt), MONTH(ven_dt)
ORDER BY 
    YEAR(ven_dt), MONTH(ven_dt);

DELETE FROM venda where ven_id = 24;
select * from venda;

SELECT 
    MONTH(ven_dt) AS Mes, 
    AVG(ven_valor) AS Media_Anual
FROM 
    venda
GROUP BY 
    MONTH(ven_dt)
ORDER BY 
    Mes;

SELECT TOP (1) SUM(ven_valor) as TOTAL ,ven_dt
                        FROM 
                            venda
                        GROUP BY venda.ven_dt
                            ORDER BY ven_dt DESC




SELECT DISTINCT  prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt, cod_venda, ven_id
                    FROM venda
                    INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
                    INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id ORDER BY ven_id DESC;

SELECT 
                    prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt
                    FROM venda
                    INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
                    INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id ORDER BY ven_dt DESC;


SELECT 
                    prod_imagem, prod_nome, ven_quantidade, usu_nome, ven_valor, ven_dt, cod_venda
                    FROM venda
                    INNER JOIN produtos ON venda.ven_prod_id = produtos.prod_id 
                    INNER JOIN usuario ON venda.ven_usu_id = usuario.usu_id ORDER BY ven_dt DESC;

USE LOJA_ESPORTIVA;

SELECT * from Venda ORDER BY ven_dt DESC OFFSET 1 ROWS FETCH NEXT 10 ROWS ONLY;

SELECT prod_id,
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
                        WHERE prod_status = 1 ORDER BY prod_id OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY;

SELECT * FROM produtos;

UPDATE usuario SET usu_senha = '123';