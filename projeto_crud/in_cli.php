<?php

include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["telefone"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];

        $stmt = $conn->prepare("INSERT INTO cliente (cli_nome, cli_email, cli_telefone) VALUES (?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $telefone);


            if ($stmt->execute()) {
                echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='index.php';</script>";
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
