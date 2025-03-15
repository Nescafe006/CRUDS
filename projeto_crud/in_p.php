<?php

include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nomep"]) && isset($_POST["preco"]) && isset($_POST["descricao"])) {
        $nomep = $_POST["nomep"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];

        $stmt = $conn->prepare("INSERT INTO produto(pro_nome, pro_descricao, pro_preco) VALUES (?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("ssd", $nomep, $descricao, $preco);
            
            if ($stmt->execute()) {
                echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='cadastro_produto.php';</script>";
            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao preparar a declaração: " . $conn->error;
        }
    } else {
        echo "Erro: Dados do formulário incompletos.";
    }
}

mysqli_close($conn);
?>