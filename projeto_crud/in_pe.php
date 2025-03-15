<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["data"]) && isset($_POST["id_clientes"]) && isset($_POST["id_produtos"])) {
        $id_clientes = $_POST["id_clientes"];
        $id_produtos = $_POST["id_produtos"];
        $data = $_POST["data"];

        $data_formatada = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $data))); 
        $stmt = $conn->prepare("INSERT INTO pedido (id_clientes, id_produtos, data_pedido) VALUES (?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("iis", $id_clientes, $id_produtos, $data_formatada);
            if ($stmt->execute()) {
                echo "<script>alert('Pedido feito com sucesso!'); window.location.href='pedidos.php';</script>";
            } else {
                echo "Erro ao pedir: " . $stmt->error;
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