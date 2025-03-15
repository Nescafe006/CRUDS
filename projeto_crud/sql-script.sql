CREATE DATABASE db_produtos;

USE db_produtos;

CREATE TABLE cliente(
id_cliente INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
cli_nome VARCHAR(45) NOT NULL,
cli_email VARCHAR(45) NOT NULL,
cli_telefone VARCHAR(14) NOT NULL
);

CREATE TABLE produto( 
id_produto INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
pro_nome VARCHAR(45) NOT NULL,
pro_descricao VARCHAR(45) NOT NULL,
pro_preco DOUBLE(9,2) NOT NULL
);

CREATE TABLE pedido(
id_pedido INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
data_pedido datetime NOT NULL,
id_clientes INT NOT NULL,
id_produtos INT NOT NULL,
CONSTRAINT fk_id_cliente FOREIGN KEY (id_clientes)
REFERENCES cliente(id_cliente),
CONSTRAINT fk_id_produto FOREIGN KEY (id_produtos)
REFERENCES produto(id_produto)
);


INSERT INTO cliente (cli_nome, cli_email, cli_telefone) 
VALUES ('Machado de Assis', 'mach@gmail.com','64992456621');

INSERT INTO produto (pro_nome, pro_descricao, pro_preco)
VALUES ('Os primeiros - a ressurreição', 'edição suprema', '300');


UPDATE cliente
SET cli_nome= 'machado'
WHERE id_cliente = 1;

UPDATE produto
SET pro_nome = 'Nárnia'
WHERE id_produto = 1;


DELETE FROM cliente
WHERE id_cliente = 1;

DELETE FROM produto
WHERE id_produto = "1";

SELECT * FROM cliente;

SELECT * FROM produto;

SELECT * FROM pedido;





