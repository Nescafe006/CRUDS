<?php
include("conexao.php");

if (!$conn) {
    echo "<p>Falha na conexão: " . mysqli_connect_error() . "</p>";
}

if (isset($_POST["editar_id"])) {
    $editar_id = $_POST["editar_id"];


    $tipo_edicao = isset($_GET["tipo_edicao"]) ? $_GET["tipo_edicao"] : null;

    if ($tipo_edicao === "cliente") {
    
        $cli_nome = mysqli_real_escape_string($conn, $_POST["cli_nome"]);
        $sql = "UPDATE cliente SET cli_nome = '$cli_nome' WHERE id_cliente = (SELECT id_clientes FROM pedido WHERE id_pedido = $editar_id)";

        if (mysqli_query($conn, $sql)) {
            echo "Pedido atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar pedido: " . mysqli_error($conn);
        }
    } elseif ($tipo_edicao === "produto") {
       
        $pro_nome = mysqli_real_escape_string($conn, $_POST["pro_nome"]);
        $sql = "UPDATE produto SET pro_nome = '$pro_nome' WHERE id_produto = (SELECT id_produtos FROM pedido WHERE id_pedido = $editar_id)";

        if (mysqli_query($conn, $sql)) {
            echo "Pedido atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar pedido: " . mysqli_error($conn);
        }
    } elseif ($tipo_edicao === "pedido") {
   
        $cli_nome = mysqli_real_escape_string($conn, $_POST["cli_nome"]);
        $pro_nome = mysqli_real_escape_string($conn, $_POST["pro_nome"]);
        $data_pedido = $_POST["data_pedido"];

       
        $sql_cliente = "SELECT id_cliente FROM cliente WHERE cli_nome = '$cli_nome'";
        $resultado_cliente = mysqli_query($conn, $sql_cliente);
        $linha_cliente = mysqli_fetch_assoc($resultado_cliente);
        $id_cliente = $linha_cliente["id_cliente"];

        $sql_produto = "SELECT id_produto FROM produto WHERE pro_nome = '$pro_nome'";
        $resultado_produto = mysqli_query($conn, $sql_produto);
        $linha_produto = mysqli_fetch_assoc($resultado_produto);
        $id_produto = $linha_produto["id_produto"];

      
        $sql = "UPDATE pedido SET id_clientes = $id_cliente, id_produtos = $id_produto, data_pedido = '$data_pedido' WHERE id_pedido = $editar_id";

        if (mysqli_query($conn, $sql)) {
            echo "Pedido atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar pedido: " . mysqli_error($conn);
        }
    }
}


?>