<?php
include("conexao.php");

if (!$conn) {
    die(json_encode(["error" => "Falha na conexão: " . mysqli_connect_error()]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id_pedido"])) {
        $id_pedido = $_POST["id_pedido"];

        $stmt = $conn->prepare("SELECT p.id_pedido, c.cli_nome, pr.pro_nome, p.data_pedido 
                               FROM pedido p
                               INNER JOIN cliente c ON p.id_clientes = c.id_cliente
                               INNER JOIN produto pr ON p.id_produtos = pr.id_produto
                               WHERE p.id_pedido = ?");

        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $pedidos = [];
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                $pedidos[] = $linha;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($pedidos);
        exit;
    } else {
        echo json_encode(["error" => "ID do pedido não fornecido."]);
    }
} else {
    echo json_encode(["error" => "Método de requisição inválido."]);
}

mysqli_close($conn);
?>