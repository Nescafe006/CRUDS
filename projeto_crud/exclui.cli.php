<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome_excluir"])) {
    $nome_excluir = mysqli_real_escape_string($conn, $_POST["nome_excluir"]);

    $stmt_check = $conn->prepare("SELECT id_cliente FROM cliente WHERE cli_nome = ?");
    $stmt_check->bind_param("s", $nome_excluir);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM cliente WHERE cli_nome = ?");
        if ($stmt) {
            $stmt->bind_param("s", $nome_excluir);
            if ($stmt->execute()) {
                echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='index.php';</script>";
            } else {
                echo "Erro ao excluir usuário: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a declaração: " . $conn->error;
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='index.php';</script>";
    }
    $stmt_check->close();
} else {
    echo "Erro: Dados incompletos.";
}

mysqli_close($conn);
?>