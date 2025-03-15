<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_excluir"])) {
    $id_excluir = $_POST["id_excluir"];

    $stmt_check = $conn->prepare("SELECT id_produto FROM produto WHERE id_produto = ?");
    $stmt_check->bind_param("i", $id_excluir);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM produto WHERE id_produto = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id_excluir);
            if ($stmt->execute()) {
                echo "<script>alert('Produto excluído com sucesso!'); window.location.href='cadastro_produto.php';</script>";
            } else {
                echo "Erro ao excluir produto: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a declaração: " . $conn->error;
        }
    } else {
        echo "<script>alert('Produto não encontrado!'); window.location.href='cadastro_produto.php';</script>";
    }
    $stmt_check->close();
} else {
    echo "Erro: Dados incompletos.";
}

mysqli_close($conn);
?>