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

-- Criação da tabela Usuarios com chave estrangeira para Tipos_Users
CREATE TABLE usuarios (
    id_usuario INT IDENTITY(1,1) PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE,
    numero VARCHAR(15),
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(150) NOT NULL,
    tipo_user INT, -- Tipo de usuário referenciando a tabela Tipos_Users
    endereco VARCHAR(200),
    estado CHAR(2),
    cidade VARCHAR(100),
    complemento VARCHAR(150),
    FOREIGN KEY (tipo_user) REFERENCES Tipos_Users(id_tipo_user) ON DELETE SET NULL
);

-- Criação da tabela Produtos com chave estrangeira para Tipos_Produtos e Usuarios
CREATE TABLE produtos (
    id_produto INT IDENTITY(1,1) PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    tipo_prod INT, -- Tipo de produto referenciando a tabela Tipos_Produtos
    preco_custo DECIMAL(10, 2) NOT NULL,
    preco_venda DECIMAL(10, 2) NOT NULL,
    descricao TEXT,
    desconto DECIMAL(5, 2),
    imagem VARCHAR(255),
    id_vendedor INT,
    FOREIGN KEY (id_vendedor) REFERENCES usuarios(id_usuario) ON DELETE SET NULL,
    FOREIGN KEY (tipo_prod) REFERENCES Tipos_Produtos(id_tipo_prod) ON DELETE SET NULL
);

SELECT * FROM LOJA_ESPORTIVA.dbo.usuarios;
SELECT * FROM LOJA_ESPORTIVA.dbo.produtos;



SELECT produtos.*, 
       usuarios.nome AS vendedor_nome
FROM produtos 
INNER JOIN usuarios ON produtos.id_vendedor = usuarios.id_usuario 
WHERE produtos.id_produto = 4;


UPDATE produtos SET	nome = 'Bola de Futebol', tipo_prod = 'Futebol', preco_custo = 412.26, preco_venda = 500.00, descricao = 'Bola da Nike com amortecimento tecnologico', desconto = null, imagem = 'teste-teste.jpg', id_vendedor = 2 WHERE id_produto = 4; 

DELETE 


-- Inserindo registros na tabela usuarios

insert into Tipos_Users (tipo_user_nome) values ('Administrador');
insert into Tipos_Users (tipo_user_nome) values ('Vendedor');
insert into Tipos_Users (tipo_user_nome) values ('Cliente');


INSERT INTO usuarios (nome, cpf, numero, email, senha, tipo_user, endereco, estado, cidade, complemento) 
VALUES ('João Silva', '12345678901', '123456789', 'joao.silva@email.com', 'senha123', 3, 'Rua A, 123', 'SP', 'São Paulo', 'Apto 45');

INSERT INTO usuarios (nome, cpf, numero, email, senha, tipo_user, endereco, estado, cidade, complemento) 
VALUES ('Maria Oliveira', '23456789012', '987654321', 'maria.oliveira@email.com', 'senha456', 2, 'Avenida B, 456', 'RJ', 'Rio de Janeiro', '');

INSERT INTO usuarios (nome, cpf, numero, email, senha, tipo_user, endereco, estado, cidade, complemento) 
VALUES ('Carlos Santos', '34567890123', '456123789', 'carlos.santos@email.com', 'senha789', 3, 'Praça C, 789', 'MG', 'Belo Horizonte', 'Casa');

INSERT INTO usuarios (nome, cpf, numero, email, senha, tipo_user, endereco, estado, cidade, complemento) 
VALUES ('Ana Souza', '45678901234', '321654987', 'ana.souza@email.com', 'senha101', 3, 'Rua D, 101', 'PR', 'Curitiba', 'Bloco B');

INSERT INTO usuarios (nome, cpf, numero, email, senha, tipo_user, endereco, estado, cidade, complemento) 
VALUES ('Pedro Lima', '56789012345', '654987321', 'pedro.lima@email.com', 'senha202', 1, 'Estrada E, 202', 'RS', 'Porto Alegre', 'Lote 3');



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
select * from produtos;
select * from usuarios;


SELECT * FROM usuarios WHERE email = 'ana.souza@email.com' && senha = 'senha101';