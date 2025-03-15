# app crud 

App crud é um website open-source que adiciona, visualiza, altera e exclui informações sobre clientes, produtos e pedidos. O seu diferencial é a capacidade de se adaptar em diferentes contextos e ritmos de trabalho.

## Tabela de conteúdos
* [Banco de dados]()
* [Funcionalidades]()
* [Instalação e execução]()

## Banco de dados 
O banco de dados escolhido para o projeto foi o [MySQL](https://www.mysql.com/): Tradicional, relacional e robusto.

## Funcionalidades 
A regra de negócio do app consiste em operações CRUD (Create, Read, Update and Delete), operações fundamentais em qualquer aplicação web. As entidades que recebem as operações são: Cliente, Produto e Aplicativo

## Instalação e Execução:

1.	Pré-requisitos: 
	Servidor web (Apache, Nginx, etc.)
	PHP 7.0 ou superior
	MySQL ou MariaDB
	Workbench para criar o banco de dados.

2.	Configuração do banco de dados: 
	Crie um banco de dados chamado db_produtos no MySQL ou MariaDB usando o Workbench.
	Execute o script SQL fornecido para criar as tabelas.
	Atualize o arquivo conexao.php com as informações de conexão do seu banco de dados.

3.	Instalação do aplicativo: 
	Copie os arquivos do projeto para o diretório raiz do seu servidor web.
  Acesse o aplicativo através do seu navegador web.

4.	Execução do aplicativo: 
	Acesse a página inicial do aplicativo para visualizar as funcionalidades disponíveis.
	Utilize os formulários e links para realizar as operações de CRUD e consulta.
