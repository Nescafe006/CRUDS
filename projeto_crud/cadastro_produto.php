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




<form action="in_p.php" method="post">

  <label for="nomep">Nome do produto: </label><br>
  <input type="text" id="nomep" name="nomep" required style="width: 300px;">
  
  <br>
  

  <label for="preco">Preço do produto:</label><br>
  <input type="text" id="preco" name="preco" required style="width: 300px;">
   <br>

  <label for="descricao">Descrição do produto:</label><br>
  <input type="text" name="descricao" id="descricao" required style="width: 300px;"></textarea>
  <br>

  <input type="submit" value="Cadastrar">

</form>


<form action="exclui_p.php" method="post">
    <label for="id_excluir">ID do Produto:</label><br>
    <input type="number" id="id_excluir" name="id_excluir" required style="width: 300px;"><br>
    <input type="submit" value="Excluir Produto">
</form>



</div>
    
    
</body>
</html>