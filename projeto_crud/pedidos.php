<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de produtos</title>
    <link rel="stylesheet" href="style.css">



</head> 

<header>

<div class="caixa-preta">


<h1>Gerenciamento de produtos</h1>
    <br>

    <div class ="caixa">
        <a href ="index.php"><button>Cliente</button></a>
        <a href ="cadastro_produto.php"><button>Produtos</button></a>
        <a href ="Form.php"><button>Fazer pedido</button></a>    
        <a href ="pedidos.php"><button>Pedidos</button></a>
            
    </div>
    


</div>

</header>

 
<body>

   <div class="caixa">
<div class="shadowbox">


    <h2>Consultar pedidos</h2>
    <form action="pedidos.php" method="post">
    <label for="id_pedido">ID do Pedido:</label>
    <input type="number" id="id_pedido" name="id_pedido"><br><br>

    <label for="nome_cliente">Nome do Cliente:</label>
    <input type="text" id="nome_cliente" name="nome_cliente"><br><br>

    <label for="nome_produto">Nome do Produto:</label>
    <input type="text" id="nome_produto" name="nome_produto"><br><br>

    <input type="submit" value="Consultar">
</form>
                <div id="resultadoConsulta">
                <?php
include("conexao.php");

if (!$conn) {
    echo "<p>Falha na conexão: " . mysqli_connect_error() . "</p>";
}


if (isset($_POST["editar_id"])) {
    include("alt_pe.php");
}


if (isset($_GET["excluir_id"])) {
    include("exclui_pe.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["novo_pedido"])) {
       
        $cli_nome = mysqli_real_escape_string($conn, $_POST["cli_nome"]);
        $pro_nome = mysqli_real_escape_string($conn, $_POST["pro_nome"]);
        $data_pedido = $_POST["data_pedido"];

 
        $sql_cliente = "SELECT id_cliente FROM cliente WHERE cli_nome = '$cli_nome'";
        $resultado_cliente = mysqli_query($conn, $sql_cliente);

        if (mysqli_num_rows($resultado_cliente) > 0) {
            $linha_cliente = mysqli_fetch_assoc($resultado_cliente);
            $id_cliente = $linha_cliente["id_cliente"];

           
            $sql_produto = "SELECT id_produto FROM produto WHERE pro_nome = '$pro_nome'";
            $resultado_produto = mysqli_query($conn, $sql_produto);

            if (mysqli_num_rows($resultado_produto) > 0) {
                $linha_produto = mysqli_fetch_assoc($resultado_produto);
                $id_produto = $linha_produto["id_produto"];

               
                $sql_inserir = "INSERT INTO pedido (id_clientes, id_produtos, data_pedido) VALUES ($id_cliente, $id_produto, '$data_pedido')";

                if (mysqli_query($conn, $sql_inserir)) {
                    echo "Pedido criado com sucesso!";
                } else {
                    echo "Erro ao criar pedido: " . mysqli_error($conn);
                }
            } else {
                echo "Erro: Produto '$pro_nome' não encontrado.";
            }
        } else {
            echo "Erro: Cliente '$cli_nome' não encontrado.";
        }
    } else {
    
        $id_pedido = isset($_POST["id_pedido"]) && $_POST["id_pedido"] !== '' ? $_POST["id_pedido"] : null;
        $nome_cliente = isset($_POST["nome_cliente"]) && $_POST["nome_cliente"] !== '' ? $_POST["nome_cliente"] : null;
        $nome_produto = isset($_POST["nome_produto"]) && $_POST["nome_produto"] !== '' ? $_POST["nome_produto"] : null;

      
        if (!empty($id_pedido) || !empty($nome_cliente) || !empty($nome_produto)) {
           
            $sql = "SELECT p.id_pedido, c.cli_nome, pr.pro_nome, p.data_pedido 
                    FROM pedido p
                    INNER JOIN cliente c ON p.id_clientes = c.id_cliente
                    INNER JOIN produto pr ON p.id_produtos = pr.id_produto
                    WHERE 1=1";

            if (!empty($id_pedido)) {
                $sql .= " AND p.id_pedido = " . intval($id_pedido);
            }

            if (!empty($nome_cliente)) {
                $sql .= " AND c.cli_nome LIKE '%" . mysqli_real_escape_string($conn, $nome_cliente) . "%'";
            }

            if (!empty($nome_produto)) {
                $sql .= " AND pr.pro_nome LIKE '%" . mysqli_real_escape_string($conn, $nome_produto) . "%'";
            }
        } else {
          
            $sql = "SELECT p.id_pedido, c.cli_nome, pr.pro_nome, p.data_pedido 
                    FROM pedido p
                    INNER JOIN cliente c ON p.id_clientes = c.id_cliente
                    INNER JOIN produto pr ON p.id_produtos = pr.id_produto";
        }

        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2>Resultado da Consulta:</h2>";
            echo "<table>";
            echo "<tr>";

         
            if (!empty($id_pedido)) {
                echo "<th>ID do Pedido</th><th>Cliente</th><th>Produto</th><th>Data do Pedido</th><th>Ações</th>";
            } elseif (!empty($nome_cliente)) {
                echo "<th>Cliente</th><th>Ações</th>";
            } elseif (!empty($nome_produto)) {
                echo "<th>Produto</th><th>Ações</th>";
            } else {
                echo "<th>ID do Pedido</th><th>Cliente</th><th>Produto</th><th>Data do Pedido</th><th>Ações</th>";
            }

            echo "</tr>";

            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";

              
                if (!empty($id_pedido)) {
                    echo "<td>" . $linha["id_pedido"] . "</td>";
                    echo "<td>" . $linha["cli_nome"] . "</td>";
                    echo "<td>" . $linha["pro_nome"] . "</td>";
                    echo "<td>" . $linha["data_pedido"] . "</td>";
                    echo "<td>
                            <a href='pedidos.php?excluir_id=" . $linha["id_pedido"] . "'>Excluir</a>
                            <a href='pedidos.php?editar_id=" . $linha["id_pedido"] . "&tipo_edicao=pedido'>Editar</a>
                          </td>";
                } elseif (!empty($nome_cliente)) {
                    echo "<td>" . $linha["cli_nome"] . "</td>";
                    echo "<td>
                  
                            <a href='pedidos.php?editar_id=" . $linha["id_pedido"] . "&tipo_edicao=cliente'>Editar</a>
                          </td>";
                } elseif (!empty($nome_produto)) {
                    echo "<td>" . $linha["pro_nome"] . "</td>";
                    echo "<td>
                          
                            <a href='pedidos.php?editar_id=" . $linha["id_pedido"] . "&tipo_edicao=produto'>Editar</a>
                          </td>";
                } else {
                    echo "<td>" . $linha["id_pedido"] . "</td>";
                    echo "<td>" . $linha["cli_nome"] . "</td>";
                    echo "<td>" . $linha["pro_nome"] . "</td>";
                    echo "<td>" . $linha["data_pedido"] . "</td>";
                    echo "<td>
                            <a href='pedidos.php?excluir_id=" . $linha["id_pedido"] . "'>Excluir</a>
                            <a href='pedidos.php?editar_id=" . $linha["id_pedido"] . "&tipo_edicao=pedido'>Editar</a>
                          </td>";
                }

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum pedido encontrado.</p>";
        }
    }
}

if (isset($_GET["editar_id"])) {
    $editar_id = $_GET["editar_id"];
    $tipo_edicao = isset($_GET["tipo_edicao"]) ? $_GET["tipo_edicao"] : null;
    $stmt = $conn->prepare("SELECT p.id_pedido, c.cli_nome, pr.pro_nome, p.data_pedido FROM pedido p INNER JOIN cliente c ON p.id_clientes = c.id_cliente INNER JOIN produto pr ON p.id_produtos = pr.id_produto WHERE p.id_pedido = ?");
    $stmt->bind_param("i", $editar_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_assoc();

    echo "<div class='shadowbox'>"; 

    if ($tipo_edicao === "cliente") {
        echo "<h2>Editar Nome do Cliente</h2>";
        echo "<form method='post' action='pedidos.php?tipo_edicao=cliente'>"; 
        echo "<input type='hidden' name='editar_id' value='" . $linha["id_pedido"] . "'>";
        echo "<label>Cliente:</label><input type='text' name='cli_nome' value='" . $linha["cli_nome"] . "'><br>";
        echo "<input type='submit' value='Salvar'>";
        echo "</form>";
    } elseif ($tipo_edicao === "produto") {
        echo "<h2>Editar Nome do Produto</h2>";
        echo "<form method='post' action='pedidos.php?tipo_edicao=produto'>";
        echo "<input type='hidden' name='editar_id' value='" . $linha["id_pedido"] . "'>";
        echo "<label>Produto:</label><input type='text' name='pro_nome' value='" . $linha["pro_nome"] . "'><br>";
        echo "<input type='submit' value='Salvar'>";
        echo "</form>";
    } elseif ($tipo_edicao === "pedido") {
        echo "<h2>Editar Pedido Completo</h2>";
        echo "<form method='post' action='pedidos.php?tipo_edicao=pedido'>"; 
        echo "<input type='hidden' name='editar_id' value='" . $linha["id_pedido"] . "'>";
        echo "<label>Cliente:</label><input type='text' name='cli_nome' value='" . $linha["cli_nome"] . "'><br>";
        echo "<label>Produto:</label><input type='text' name='pro_nome' value='" . $linha["pro_nome"] . "'><br>";
        echo "<label>Data do Pedido:</label><input type='date' name='data_pedido' value='" . $linha["data_pedido"] . "'><br>";
        echo "<input type='submit' value='Salvar'>";
        echo "</form>";
    }

    echo "</div>"; 
}

if (isset($conn) && $conn) {
    mysqli_close($conn);
}
?>
                </div>
                </div>
           

            
    
        
    </body>
</html>