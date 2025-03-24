<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome_excluir"])) {
    $nome_excluir = mysqli_real_escape_string($conn, $_POST["nome_excluir"]);

    $stmt_check = $conn->prepare("SELECT id_aluno FROM aluno WHERE id aluno = ?");
    $stmt_check->bind_param("s", $nome_excluir);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM aluno WHERE id id_aluno = ?");
        if ($stmt) {
            $stmt->bind_param("i", $nome_excluir);
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