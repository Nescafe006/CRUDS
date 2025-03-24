<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if (isset($_GET["excluir_id"])) {
    $excluir_id = $_GET["excluir_id"];

    
    mysqli_begin_transaction($conn);

    try {
      
        $stmt = $conn->prepare("DELETE FROM inscricao WHERE id_inscricao = ?");
        $stmt->bind_param("i", $excluir_id);

        if ($stmt->execute()) {
            echo "<p>Inscrição excluída com sucesso!</p>";
            mysqli_commit($conn);
        } else {
            throw new Exception("Erro ao excluir inscrição: " . $stmt->error);
        }
    } catch (Exception $e) {
     
        mysqli_rollBack($conn);
        echo "<p>Erro: " . $e->getMessage() . "</p>";
    }
}
?>
