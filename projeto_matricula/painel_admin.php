<?php
session_start();


if (!isset($_SESSION['id_usuario']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: login.php"); 
    exit();
}


echo "<h1>Bem-vindo ao painel de administrador, " . $_SESSION['usuario_nome'] . "!</h1>";

echo "<a href='index.php'>Cadastrar Aluno</a><br>";
echo "<a href='curso.php'>Cadastrar Curso</a><br>";
echo "<a href='Form.php'>Fazer Inscrição</a><br>";
echo "<a href='inscricao.php'>Visualizar Inscrições</a><br>";
?>
<a href="logout.php">Sair</a>