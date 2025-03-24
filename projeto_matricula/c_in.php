<?php

include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    if (isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["carga"])  && isset($_POST["instrutor"])) {

        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $carga = $_POST["carga"];
        $instrutor = $_POST["instrutor"];

        $stmt = $conn->prepare("INSERT INTO curso(c_nome, c_descricao, c_ch, c_prof) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("ssis", $nome, $descricao, $carga, $instrutor);


            if ($stmt->execute()) {
                echo "<script>alert('curso cadastrado com sucesso!'); window.location.href='index.php';</script>";
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
