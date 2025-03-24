<?php
session_start();


if (!isset($_SESSION['id_usuario']) || $_SESSION['usuario_tipo'] !== 'usuario') {
    header("Location: login.php");
    exit();
}


echo "<h1>Bem-vindo, " . $_SESSION['usuario_nome'] . "!</h1>";

echo "<a href='Form.php'>Fazer Inscrição</a><br>";
?>
<a href="logout.php">Sair</a>
