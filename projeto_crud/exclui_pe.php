<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if (isset($_GET["excluir_id"])) {
    $excluir_id = $_GET["excluir_id"];
    $stmt = $conn->prepare("DELETE FROM pedido WHERE id_pedido = ?");
    $stmt->bind_param("i", $excluir_id);
    if ($stmt->execute()) {
        echo "<p>Pedido excluído com sucesso!</p>";
    } else {
        echo "<p>Erro ao excluir pedido: " . $stmt->error . "</p>";
    }
    $stmt->close();
}


?>