<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de pr</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="caixa-preta">
            <h1>Gerenciador de produtos</h1>
            <br>

            <div class ="caixa">
        <a href ="index.php"><button>Cliente</button></a>
        <a href ="cadastro_produto.php"><button>Produtos</button></a>
        <a href ="Form.php"><button>Fazer pedido</button></a>    
        <a href ="pedidos.php"><button>Pedidos</button></a>
            
        </div>

    </header>
    <body>
        <div class="caixa">
            <div class="shadowbox">
                <form action="in_pe.php" method="post" class="caixa form">

                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required><br><br>

                    <label for="id_clientes">Cliente:</label>
                    <select name="id_clientes" id="id_clientes" required>

                        <?php
                        include("conexao.php");
                        $sqlClientes = "SELECT id_cliente, cli_nome FROM cliente";
                        $resultadoClientes = $conn->query($sqlClientes);
                        if ($resultadoClientes->num_rows > 0) {
                            while ($linhaCliente = $resultadoClientes->fetch_assoc()) {
                                echo "<option value='" . $linhaCliente["id_cliente"] . "'>" . $linhaCliente["cli_nome"] . "</option>";
                            }
                        }
                        ?>
                    </select><br><br>

                    <label for="id_produtos">Produto:</label>
                    <select name="id_produtos" id="id_produtos" required>
                        <?php
                        $sqlProdutos = "SELECT id_produto, pro_nome FROM produto";
                        $resultadoProdutos = $conn->query($sqlProdutos);
                        if ($resultadoProdutos->num_rows > 0) {
                            while ($linhaProduto = $resultadoProdutos->fetch_assoc()) {
                                echo "<option value='" . $linhaProduto["id_produto"] . "'>" . $linhaProduto["pro_nome"] . "</option>";
                            }
                        }
                        ?>
                    </select><br><br>

                    <input type="submit" value="Encomendar">
                </form>
            </div>
        </div>
    </body>
</html>