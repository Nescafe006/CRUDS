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

    <h2></h2>

<form action="in_cli.php" method="post">

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required style="width: 300px;"><br>

    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" required style="width: 300px;"><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" id="telefone" name="telefone" required style="width: 300px;"><br>


    <input type="submit" value="Cadastrar">

</form>



<form action="exclui.cli.php" method="post">
    <label for="nome_excluir">Nome do Usuário:</label><br>
    <input type="text" id="nome_excluir" name="nome_excluir" required style="width: 300px;"><br>
    <input type="submit" value="Excluir Usuário">
</form>

</div>
    
    
</body>
</html>