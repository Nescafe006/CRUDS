CREATE DATABASE db_cursos;

USE db_cursos;

CREATE TABLE aluno( 
id_aluno INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
a_nome VARCHAR(45) NOT NULL,
a_email VARCHAR(45) NOT NULL,
a_telefone VARCHAR(45) NOT NULL
);

CREATE TABLE curso(
id_curso INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
c_nome VARCHAR(45) NOT NULL,
c_descricao VARCHAR(45) NOT NULL,
c_ch INT NOT NULL,
c_prof VARCHAR(45) NOT NULL
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario_nome VARCHAR(100) NOT NULL,
    usuario_email VARCHAR(100) NOT NULL UNIQUE,
    usuario_senha VARCHAR(255) NOT NULL,
    usuario_tipo ENUM('admin', 'usuario') NOT NULL
);


CREATE TABLE inscricao(
id_inscricao INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
data_inscricao datetime NOT NULL,
id_alunos INT NOT NULL,
id_cursos INT NOT NULL,
CONSTRAINT fk_id_aluno FOREIGN KEY (id_alunos)
REFERENCES aluno(id_aluno),
CONSTRAINT fk_id_curso FOREIGN KEY (id_cursos)
REFERENCES curso(id_curso)
);

INSERT INTO usuarios (usuario_nome, usuario_email, usuario_senha, usuario_tipo) 
VALUES 
('admin', 'admin@example.com', MD5('admin123'), 'admin');

INSERT INTO usuarios (usuario_nome, usuario_email, usuario_senha, usuario_tipo) 
VALUES 
('usuario', 'usuario@example.com', MD5('usuario123'), 'usuario');






