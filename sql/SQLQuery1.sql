USE LOJA_ESPORTIVA;

-- Criação da tabela Tipos_Users
CREATE TABLE Tipos_Users (
    id_tipo_user INT IDENTITY(1,1) PRIMARY KEY,
    tipo_user_nome VARCHAR(20) NOT NULL
);

-- Criação da tabela Tipos_Produtos
CREATE TABLE Tipos_Produtos (
    id_tipo_prod INT IDENTITY(1,1) PRIMARY KEY,
    tipo_prod_nome VARCHAR(90) NOT NULL
);
CREATE TABLE Estado (
    id_estado INT IDENTITY(1,1) PRIMARY KEY,
    nome_estado VARCHAR(2) NOT NULL
);

CREATE TABLE Cidade (
    id_cidade INT IDENTITY(1,1) PRIMARY KEY,
    nome_cidade VARCHAR(100) NOT NULL
);

-- Criação da tabela Usuarios com chave estrangeira para Tipos_Users
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
	usu_hr_ini time NOT NULL,
	usu_usu_status bit NOT NULL,
	usu_dt_exc DATE NULL,
	usu_hr_exc time NULL,
    FOREIGN KEY (usu_tipo) REFERENCES Tipos_Users(id_tipo_user),
	FOREIGN KEY (usu_estado) REFERENCES Estado(id_estado),
	FOREIGN KEY (usu_cidade) REFERENCES Cidade(id_cidade),
);

CREATE TABLE usuarios (
    usu_id INT IDENTITY(1,1) PRIMARY KEY,
    usu_nome VARCHAR(150) NOT NULL,
    usu_senha VARCHAR(150) NOT NULL
);

INSERT INTO usuarios (usu_nome, usu_senha) VALUES ('admin', 'admin0000');

-- Criação da tabela Produtos com chave estrangeira para Tipos_Produtos e Usuarios
CREATE TABLE produtos (
    prod_id INT IDENTITY(1,1) PRIMARY KEY,
    prod_nome VARCHAR(150) NOT NULL,
    prod_tipo INT, -- Tipo de produto referenciando a tabela Tipos_Produtos
    prod_custo DECIMAL(10, 2) NOT NULL,
    prod_venda DECIMAL(10, 2) NOT NULL,
    prod_descricao TEXT,
	prod_quantidade INT,
    prod_desconto DECIMAL(5, 2),
    prod_imagem VARCHAR(255),
    prod_usu_cad INT,
	prod_dt_ini DATE NOT NULL,
	prod_status bit NOT NULL,
	prod_dt_exc DATE NULL,
    FOREIGN KEY (prod_usu_cad) REFERENCES usuario(usu_id) ON DELETE SET NULL,
    FOREIGN KEY (prod_tipo) REFERENCES Tipos_Produtos(id_tipo_prod) ON DELETE SET NULL
);

SELECT * FROM LOJA_ESPORTIVA.dbo.usuario;
SELECT * FROM LOJA_ESPORTIVA.dbo.produtos;

DELETE FROM usuario WHERE usu_id = 10

SELECT produtos.*, 
       usuarios.nome AS vendedor_nome
FROM produtos 
INNER JOIN usuarios ON produtos.id_vendedor = usuarios.id_usuario 
WHERE produtos.id_produto = 4;


UPDATE produtos SET	nome = 'Bola de Futebol', tipo_prod = 'Futebol', preco_custo = 412.26, preco_venda = 500.00, descricao = 'Bola da Nike com amortecimento tecnologico', desconto = null, imagem = 'teste-teste.jpg', id_vendedor = 2 WHERE id_produto = 4; 

select * from Tipos_Users;

-- Inserindo registros na tabela usuarios

insert into Tipos_Users (tipo_user_nome) values ('Administrador');
insert into Tipos_Users (tipo_user_nome) values ('Vendedor');
insert into Tipos_Users (tipo_user_nome) values ('Cliente');

INSERT INTO usuario 
(usu_nome, usu_cpf, usu_telefone, usu_email, usu_senha, usu_tipo, usu_endereco, usu_numero, usu_estado, usu_cidade, usu_complemento, usu_dt_ini, usu_status, usu_dt_exc) 
VALUES 
-- Cliente 1
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




SELECT * FROM usuario WHERE usu_email = 'joao.souza@hotmail.com' AND usu_senha = 'minhaSenha789' AND usu_status = 1;

select *from clientes;
-- Inserindo registros na tabela produtos

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

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Camiseta Esportiva da Nike', 1, 50.00, 70.00, 'Camiseta leve e respirável, ideal para atividades físicas.', NULL, 'camiseta_esportiva.jpg', 1);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Bola de Futebol', 3, 120.00, 150.00, 'Bola de futebol profissional com garantia de qualidade.', NULL, 'bola_futebol.jpg', 2);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Boné Adidas', 4, 30.00, 50.00, 'Boné estiloso da Adidas, perfeito para atividades ao ar livre.', NULL, 'bone_adidas.jpg', 1);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Tênis de Corrida', 5, 200.00, 300.00, 'Tênis de corrida com amortecimento e suporte ao pé.', 10.00, 'tenis_corrida.jpg', 2);

INSERT INTO produtos (nome, tipo_prod, preco_custo, preco_venda, descricao, desconto, imagem, id_vendedor) 
VALUES ('Mochila para Hiking', 7, 80.00, 120.00, 'Mochila resistente, ideal para caminhadas e aventuras ao ar livre.', NULL, 'mochila_hiking.jpg', 1);

select * from Tipos_Users;
select * from Tipos_Produtos;
select * from usuarios;
select * from produtos;


SELECT * FROM usuarios WHERE email = 'marcosmarcondes700@gmail.com' AND senha = '@tar2024'


SELECT 
    produtos.nome AS nome_prod, 
    Tipos_Produtos.tipo_prod_nome,
    produtos.descricao, 
    produtos.preco_custo, 
    produtos.preco_venda, 
    produtos.desconto, 
    produtos.imagem, 
    usuarios.nome AS vendedor_nome
FROM 
    produtos
INNER JOIN 
    Tipos_Produtos ON produtos.tipo_prod = Tipos_Produtos.id_tipo_prod  
INNER JOIN 
    usuarios ON produtos.id_vendedor = usuarios.id_usuario;


SELECT * FROM usuarios WHERE email = 'ana.souza@email.com' && senha = 'senha101';


SELECT produtos.nome as nome_prod, produtos.tipo_prod, produtos.descricao, produtos.preco_custo, produtos.preco_venda, produtos.desconto, produtos.imagem, usuarios.nome as vendedor_nome FROM produtos
                    INNER JOIN Tipos_Produtos ON produtos.tipo_prod = Tipos_Produtos.id_tipo_prod  
                    INNER JOIN usuarios ON produtos.id_vendedor = usuarios.id_usuario
                    WHERE produtos.id_produto = 13;


					UPDATE produtos SET	nome = 'TESTE', tipo_prod = 1, preco_custo = '123', preco_venda = '123', descricao = 'g', desconto = '0', imagem = 'teste.png', id_vendedor = 1 WHERE id_produto = 13;





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